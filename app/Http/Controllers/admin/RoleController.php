<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    public function __construct() {
        $this->moduleName = 'Roles ';
        $this->moduleRoute = 'roles';
        // $this->moduleView = 'system_admin';
         $this->moduleForm = 'admin.roles._form';

        View::share('module_name', $this->moduleName);
        View::share('module_route', $this->moduleRoute);
        // View::share('module_view', $this->moduleView);
         View::share('module_form', $this->moduleForm);
    }
    public function index() {
        return view("admin.roles.index");
    }

    public function getDatatable(Request $request) {
        $result = Role::all();

        return DataTables::of($result)->addIndexColumn()->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view("admin.general.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'name'         => ['required', 'string', 'max:255'],
            'display_name' => ['required', 'string', 'max:255'],
        ]);

        $input = $request->only(['name', 'display_name', 'description']);
       

            $data = Role::create($input);

        //$data = Role::create($input);
        if ($data) {
            return redirect()->route("roles.index")->with('success', 'Role Created Successfully');
        }
        return redirect()->route("roles.index")->with('error', 'Sorry, Something went wrong please try again');
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
        $result = Role::find($id);

        //$result = Role::find($id);
        if ($result) {
            return view("admin.general.edit", compact('result'));
        }
        return redirect()->route("roles.index")->with('error', "Sorry, role not found");
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
        $this->validate($request, [
            'display_name' => ['required', 'string', 'max:255'],
        ]);
        $input = $request->only(['display_name', 'description']);

            $data = Role::find($id);

        //$data = Role::find($id);

        if ($data) {
            $isSaved = $data->update($input);
            if ($isSaved) {
                return redirect()->route("roles.index")->with('success', 'Role Updated Successfully');
            }
        }
        return redirect()->route("roles.index")->with('error', 'Sorry, Something went wrong please try again');
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


            $data = Role::find($id);

        //$data = Role::find($id);
        if ($data) {
            $data = Role::whereId($id)->delete();
            if ($data) {
                $result['message'] = 'Role Deleted.';
                $result['status'] = true;
            } else {
                $result['message'] = 'Error while deleting role';
                $result['status'] = false;
            }
        } else {
            $result['message'] = 'role not Found!';
            $result['status'] = false;
        }

        return response()->json($result);
    }
}
