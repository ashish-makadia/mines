<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function __construct() {
        $this->moduleName = 'Users ';
        $this->moduleRoute = 'user';
        // $this->moduleView = 'system_admin';
         $this->moduleForm = 'admin.user._form';

        View::share('module_name', $this->moduleName);
        View::share('module_route', $this->moduleRoute);
        // View::share('module_view', $this->moduleView);
         View::share('module_form', $this->moduleForm);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request){
        if($request->ajax()) {
            $data =User::with('role')->orderBy('id', 'DESC')->select('*');
            return DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.user.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        $roles = Role::get();
        return view("admin.general.create",compact("roles"));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
    		'name'	=> 'required',
    		'email'	=> 'required|unique:users|email',
    		'password' => 'required',
    	]);
		$user = User::create([
			'name'	=> $request->name,
            'role_id'	=> $request->role_id,
			'email'	=> $request->email,
			'password'	=> \Hash::make($request->password),
		]);

        if($user){
            return redirect("/user")->with("message",'User created successfully');
        }
        return redirect()->back()->with("error",'somthing wrong');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $roles = Role::get();
        $result = User::find($id);
        return view("admin.general.edit",compact("roles","result"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
    		'name'	=> 'required',
    		// 'email'	=> 'required|unique:users|email,'.$id,
            'email' => "required|unique:users,email,$id,id"

    	]);
		$user = User::where("id",$id)->update([
			'name'	=> $request->name,
            'role_id'	=> $request->role_id,
			'email'	=> $request->email,
		]);

        if($user){
            return redirect("/user")->with("message",'User updated successfully');
        }
        return redirect()->back()->with("error",'somthing wrong');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = User::find($id);

        if ( $data ) {
            $data->delete();
            return response()->json(['message' => config('constant.delete_unit')]);
        }

        return response()->json(['error' => config('constant.somthing_wrong')]);
    }
}
