<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Http\Helpers\CommonFunction;
use Illuminate\Support\Facades\Auth ;
use App\Models\State;
use App\Models\City;

class DashboardController extends Controller
{
     public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $permission = Permission::where("name","dashboard_view")->first();
            $isPermission = CommonFunction::checkPermission($permission->id);
            if(!$isPermission){
                return redirect("/dashboard")->with("error","permission not allowed for this module");
            }
             return $next($request);
        });
    }
	public function index(){
		return view('admin.dashboard');
	}
    public function home (){
        

        $states = State::get();

        return view('admin.dashboard',compact('states'));
    }

    public function getCity(Request $request)
    {   
        $city_ajax = City::where("state_id",$request->state_id)->get();
        return response()->json($city_ajax);
    }
}
