<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class PermissionController extends Controller
{
    public function __construct() {
        $this->moduleName = 'Roles ';
        $this->moduleRoute = 'permission';
        // $this->moduleView = 'system_admin';
         $this->moduleForm = 'admin.permission._form';

        View::share('module_name', $this->moduleName);
        View::share('module_route', $this->moduleRoute);
        // View::share('module_view', $this->moduleView);
         View::share('module_form', $this->moduleForm);
    }
    public function index() {
        return view("admin.permission.index");
    }

    public function getDatatable(Request $request) {
        $result = Permission::get();
        return DataTables::of($result)->addIndexColumn()->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $allConfigPermissoins = [];

        $allConfigPermissoins = collect(Config::get('permissionList'));

        $allPermissoins = $allConfigPermissoins->collapse();
        $newPermissions = [];

        if ($allPermissoins->count()) {
            $allStoredPermissions = Permission::orderBy('name')->pluck('name');
            $newPermissions = $allPermissoins->whereNotIn('name', $allStoredPermissions)->values();
        }

        return view("admin.permission.create", compact('newPermissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $result = [];

        $names = $request->get('names');
        $isAlreadyFound = Permission::whereIn('name', $names)->first();
        if ($isAlreadyFound) {
            $result['message'] = 'There is one permission already exists';
            $result['code'] = 400;
        } else {
            $allConfigPermissoins = [];
            $allConfigPermissoins = collect(Config::get('permissionList'));
            $allConfigPermissoins = $allConfigPermissoins->map(function ($item, $modelName) {
                $item = collect($item)->map(function ($obj, $key) use ($modelName) {
                    $obj['module_name'] = strtolower($modelName);
                    return $obj;
                });

                return $item;
            });

            $allPermissoins = $allConfigPermissoins->collapse();

            $newPermissions = $allPermissoins->whereIn('name', $names);
            $user_type = Auth::user()->user_type;
            $newPermissions = $newPermissions->each(function ($item, $key) use ($user_type) {
                $item['guard_name'] = config('auth.defaults.guard');
                $item['created_at'] = Carbon::now()->toDateTimeString();
                $item['updated_at'] = Carbon::now()->toDateTimeString();

                $isAlreadyFound = Permission::create($item);
            });

            $result['message'] = 'Permissions added Successfully.';
            $result['code'] = 200;
        }

        return response()->json($result, $result['code']);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $authUser = Auth::user();
        //$result = $this->model::find($id);

        $result = Permission::find($id);

        if ($result) {
            return view("admin.general.edit", compact('result'));
        }
        return redirect()->route("premission.index")->with('error', "Sorry, Permission not found");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $input = $request->only(['display_name', 'description']);

        $result = Permission::find($id);

        //$result = TenantPermission::find($id);

        if ($result) {
            $isSaved = $result->update($input);
            if ($isSaved) {
                return redirect()->route("permission.index")->with('success',  'Permission Updated Successfully');
            }
        }

        return redirect()->route("permission.index")->with('error', 'Sorry, Something went wrong please try again');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $result = [];
        //$responseData = TenantPermission::find($id);

        $responseData = Permission::find($id);

        if ($responseData) {
            $res = $responseData->delete();
            if ($res) {
                // Clear Permission Cache
                app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

                $result['message'] =  'Permission Deleted.';
                $result['code'] = 200;
                $result['status'] = true;
            } else {
                $result['message'] = 'Error while deleting Permission';
                $result['code'] = 400;
                $result['status'] = false;
            }
        } else {
            $result['message'] = 'permission not Found!';
            $result['code'] = 400;
            $result['status'] = false;
        }

        return response()->json($result, $result['code']);
    }
}
