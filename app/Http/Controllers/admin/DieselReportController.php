<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\DieselReport;
use App\Models\DieselStock;
use Spatie\Permission\Models\Permission;
use App\Http\Helpers\CommonFunction;
use Illuminate\Support\Facades\Auth ;
use App\Models\Vendor_Managment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class DieselReportController extends Controller
{
     public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $permission = Permission::where("name","diesel_stock")->first();
            $isPermission = CommonFunction::checkPermission($permission->id);
            if(!$isPermission){
                return redirect("/dashboard")->with("error","permission not allowed for this module");
            }
             return $next($request);
        });
    }
    public function index(Request $request){
        $vendors = Vendor_Managment::get();
        if($request->ajax()) {
            $diesel_stock = DieselReport::with("vendor")->orderBy('id', 'DESC');
            return DataTables::of($diesel_stock) ->addIndexColumn()->make(true);
        }
        return view('admin.reports.diesel_stock.index',compact('vendors'));
    }
    public function store(Request $request){
        $inputs = $request->except("_token");
        $inputs["mine_id"] = Session::get("mine_id");
        $inputs["payment_date"] = date("Y-m-d");
        if(DieselReport::create($inputs)){
            return redirect()->back()->with('message',config('constant.add_diesel_stock_report'));
        } else {
            return redirect()->back()->with('error', 'something went wrong please try again later.');
        }
    }
    public function getVendorDiesel(Request $request){
        $dieselStock = DieselStock::where("vendor_id",$request->id)->get();
        $paidAmount = DieselReport::select(DB::raw('SUM("payment_amount") as paidAmount'))->where("vendor_id",$request->id)->sum("payment_amount");
        $totalDiesel = 0;
        $totalRate = 0;
        $dieselStockArr = [];
        foreach($dieselStock as $key => $value) {
           $totalDiesel += $value->stock;
           $totalRate += $value->stock*$value->rate_per_ltr;
        }
        $dieselStockArr["total_diesel"] = $totalDiesel;
        $dieselStockArr["total_amount"] = $totalRate-$paidAmount;
        return response()->json($dieselStockArr);
    }
    public function edit(string $id)
    {
        $diesel_stock = DieselReport::where('id', $id)->first();
        // return response()->json(view('admin.sale_assets.edit', compact('assetCategorys','assets_type','vendors','assign_assets'))->render());
        return response()->json(["diesel_stock"=>$diesel_stock]);
    }
    public function update(Request $request,$id){
        $inputs = $request->except("_token","_method");
        if(DieselReport::where("id",$id)->update($inputs)){
            return redirect()->back()->with('message',config('constant.update_diesel_stock_report'));
        } else {
            return redirect()->back()->with('error', 'something went wrong please try again later.');
        }
    }
    public function destroy(string $id)
    {
        if(DieselReport::where("id",$id)->delete()) {
            // return response()->json()->with('message',config('constant.delete_sales_assets'));
            return response()->json(['message' => config('constant.delete_diesel_stock')]);
        }
        return response()->json(['error' => config('constant.somthing_wrong')]);
    }
}
