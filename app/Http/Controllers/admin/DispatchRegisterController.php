<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AssetCategroy;
use App\Models\AssetsStock;
use App\Models\DispatchRegister;
use App\Models\Mine;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use App\Http\Helpers\CommonFunction;
use Illuminate\Support\Facades\Auth ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class DispatchRegisterController extends Controller
{
     public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $permission = Permission::where("name","dispatch_register")->first();
            $isPermission = CommonFunction::checkPermission($permission->id);
            if(!$isPermission){
                return redirect("/dashboard")->with("error","permission not allowed for this module");
            }
             return $next($request);
        });
    }
    /**
     */
    public function index(Request $request)
    {
        $mine_id = Session::get("mine_id");
        $assetCategorys = AssetCategroy::get();
        $users = User::get();
        $mines = Mine::get();
        if($request->ajax()) {
            $sale_assets =DispatchRegister::with("mines","user","assetscategory","assets")->where("mine_id",$mine_id)->orderBy('id', 'DESC')->select('*');
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
        $inputs["mine_id"] = Session::get("mine_id");
        if($disaptch = DispatchRegister::create($inputs)) {
            AssetsStock::create([
                "working_assets" =>  $request->issued_assets,
                "item_name" => $request->assets_name,
                "quantity" =>$request->quantity_issued,
                "type" => "sale",
                "sale_id" => $disaptch->id,
            ]);
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
        $inputs["mine_id"] = Session::get("mine_id");
        if(DispatchRegister::where("id",$id)->update($inputs)) {
            AssetsStock::where("sale_id" ,$id)->update([
                "working_assets" =>  $request->issued_assets,
                "item_name" => $request->assets_name,
                "quantity" =>$request->quantity_issued,
                "type" => "sale"
            ]);
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
            AssetsStock::where("sale_id" ,$id)->delete();
            // return response()->json()->with('message',config('constant.delete_sales_assets'));
            return response()->json(['message' => config('constant.delete_dispatch_register')]);
        }
        return response()->json(['error' => config('constant.somthing_wrong')]);
    }
}
