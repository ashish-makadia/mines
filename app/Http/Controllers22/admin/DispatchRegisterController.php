<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AssetCategroy;
use App\Models\DispatchRegister;
use App\Models\Mine;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DispatchRegisterController extends Controller
{
    /**
     */
    public function index(Request $request)
    {
        $assetCategorys = AssetCategroy::get();
        $users = User::get();
        $mines = Mine::get();
        if($request->ajax()) {
            $sale_assets =DispatchRegister::with("mines","user","assetscategory")->orderBy('id', 'DESC')->select('*');
            return DataTables::of($sale_assets) ->addIndexColumn()->make(true);
        }
        return view('admin.dispatch_register.index',compact("users","assetCategorys","mines"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $inputs = $request->except('_token');

        if(DispatchRegister::create($inputs)) {
            return redirect()->back()->with('message',config('constant.add_dispatch_register'));
        }
        return redirect()->back()->with('error',config('constant.somthing_wrong'));
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
        $assetCategorys = AssetCategroy::get();
        $users = User::get();
        $mines = Mine::get();
        $dispatch_register = DispatchRegister::find($id);
        return response()->json(view('admin.dispatch_register.edit', compact('dispatch_register','mines','assetCategorys','users'))->render());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $inputs = $request->except('_token','_method');
        if(DispatchRegister::where("id",$id)->update($inputs)) {
            return redirect()->back()->with('message',config('constant.update_dispatch_register'));
        }
        return redirect()->back()->with('error',config('constant.somthing_wrong'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(DispatchRegister::where("id",$id)->delete()) {
            // return response()->json()->with('message',config('constant.delete_sales_assets'));
            return response()->json(['message' => config('constant.delete_dispatch_register')]);
        }
        return response()->json(['error' => config('constant.somthing_wrong')]);
    }
}
