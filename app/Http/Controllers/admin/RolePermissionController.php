<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\View;
use Spatie\Permission\Models\Permission;
use App\Models\Role;

class RolePermissionController extends Controller {

    public function __construct() {
        $this->moduleName = 'Roles Permission';
        $this->moduleRoute = 'role-permission';
        // $this->moduleView = 'admin';
        $this->moduleForm = 'admin.role-permission._form';

        View::share('module_name', $this->moduleName);
        View::share('module_route', $this->moduleRoute);
        // View::share('module_view', $this->moduleView);
         View::share('module_form', $this->moduleForm);
    }
    public function index() {
        return view("admin.role-permission.index");
    }

    public function getDatatable(Request $request) {
        $result = Role::get();
        return DataTables::of($result)->addIndexColumn()->make(true);
    }

    public function edit($id) {
        $roles = Role::with(['permissions'])->find($id);
        $permissions = Permission::all()->groupBy('module_name');

        $viewData = [
            'result'      => $roles,
            'permissions' => $permissions,
        ];
        //  dd($viewData);
        return view("admin.general.edit", $viewData);
    }

    public function update(Request $request, $id) {
        $role = Role::with(['permissions'])->find($id);
        Artisan::call('permission:cache-reset');

        $permissions = [];
        if ($request->permission) {
            $permissions = $request->permission;
        }

        $role->update(["permissions"=>json_encode($permissions)]);
        // $role->syncPermissions($permissions);

        return redirect()->route("role-permission.index")->with('success', 'Permission successfully updated.');
    }
}
