<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Mine;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index(){
        $mines= Mine::get();
    	return view('admin.auth.login',compact('mines'));
    }
    public function login(Request $request){

    	$credentials = $request->validate([
    		'email'	=> 'required',
    		'password' => 'required',
            'mine_id' => 'required'
    	]);

        if(\Auth::attempt($request->only('email','password'))){
            Session::put('mine_id', $request->mine_id);
            return redirect()->route('dashboard')->with('message',config('constant.login'));
        }
        return redirect()->route('login')->with('error',config('constant.incorrect_credentials'));
    }
    public function registr_view(){
    	return view('auth.ragister');
    }

    public function registr(Request $request){

    	$request->validate([
    		'name'	=> 'required',
    		'email'	=> 'required|unique:users|email',
    		'password' => 'required',
    	]);
		User::create([
			'name'	=> $request->name,
			'email'	=> $request->email,
			'password'	=> \Hash::make($request->password),
		]);

		if(\Auth::attempt($request->only('email','password'))){
			return redirect('dashboard');
		}
		return redirect('register')->withError('somthing wrong');
    }

    // public function dashboard(){
    // 	return view('home');
    // }

     public function logout(){
        \Session::flush();
        \Auth::logout();
        return redirect('/');
    }

     public function changepassword ($id){

        return view('admin.auth.chnagepassword',compact('id'));
     }

     public function postchangepassword (Request $request){


        $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed', // 'password_confirmation' field must be present
        ]);

        $oldPassword = $request->old_password;
        $userId = $request->editid;

        $user = User::find($userId);

        if ($user && Hash::check($oldPassword, $user->password)) {
            $user->password =  \Hash::make($request->password);
            $user->save();
            return redirect()->back()->with('message',config('constant.change_password'));
        } else {
            // return "Password does not match.";
              return redirect()->back()->withErrors(['old_password' => 'Old Password does not match.']);
        }
     }
}
