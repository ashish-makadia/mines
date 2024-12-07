<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AssetsVendor;
use App\Models\DieselReport;
use App\Models\Machinary_assets_list;
use App\Models\Vendor_Managment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Permission\Models\Permission;
use App\Http\Helpers\CommonFunction;
use Illuminate\Support\Facades\Auth ;

class AssetsVendorController extends Controller
{
     public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $permission = Permission::where("name","assets_vendor")->first();
            $isPermission = CommonFunction::checkPermission($permission->id);
            if(!$isPermission){
                return redirect("/dashboard")->with("error","permission not allowed for this module");
            }
             return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $vendors = Vendor_Managment::get();
        if($request->ajax()) {
            $diesel_stock = AssetsVendor::with("vendor")->orderBy('id', 'DESC');
            return DataTables::of($diesel_stock) ->addIndexColumn()->make(true);
        }
        return view('admin.reports.assets_vendor.index',compact('vendors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vendors = Vendor_Managment::get();
        return view('admin.reports.assets_vendor.create',compact('vendors'));
    }


    public function getVendorAssets(Request $request)
    {
        $assets = Machinary_assets_list::where("vendor_id",$request->id)->get();
        $totalAmount = Machinary_assets_list::select(DB::raw('SUM("total_payble_amount") as totalAmount'))->where("vendor_id",$request->id)->sum("total_payble_amount");
        $paidAmount = AssetsVendor::select(DB::raw('SUM("payment_amount") as paidAmount'))->where("vendor_id",$request->id)->sum("payment_amount");
        return response()->json(["assets"=>$assets,"totalAmount"=>$totalAmount-$paidAmount]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $inputs = $request->except("_token");
        $inputs["mine_id"] = Session::get("mine_id");
        $inputs["payment_date"] = date("Y-m-d");
        if(AssetsVendor::create($inputs)){
            return redirect('reports-assets-vendor')->with('message',config('constant.add_diesel_stock_report'));
        } else {
            return redirect()->back()->with('error', 'something went wrong please try again later.');
        }
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
        $assets_vendor = AssetsVendor::find($id);
        $vendors = Vendor_Managment::get();
        $assets = Machinary_assets_list::where("vendor_id",$assets_vendor->vendor_id)->get();
        $totalAmount = Machinary_assets_list::select(DB::raw('SUM("total_payble_amount") as totalAmount'))->where("vendor_id",$assets_vendor->vendor_id)->sum("total_payble_amount");

        return view('admin.reports.assets_vendor.edit',compact('assets','totalAmount','vendors','assets_vendor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $inputs = $request->except("_token","_method");
        $inputs["mine_id"] = Session::get("mine_id");
        $inputs["payment_date"] = date("Y-m-d");
        if(AssetsVendor::where("id",$id)->update($inputs)){
            return redirect('reports-assets-vendor')->with('message',config('constant.update_assets_vendor_report'));
        } else {
            return redirect()->back()->with('error', 'something went wrong please try again later.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(AssetsVendor::where("id",$id)->delete()) {
            return response()->json(['message' => config('constant.update_assets_vendor')]);
        }
        return response()->json(['error' => config('constant.somthing_wrong')]);
    }
}
