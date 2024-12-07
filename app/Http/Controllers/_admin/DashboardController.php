<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\State;
use App\Models\City;

class DashboardController extends Controller
{
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
