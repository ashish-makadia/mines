<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use App\Http\Helpers\CommonFunction;
use Illuminate\Support\Facades\Auth ;
use App\Models\AssetCategroy;
use App\Models\MeterReading;
use App\Models\Mine;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MeterReadingController extends Controller
{
     public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $permission = Permission::where("name","meter_reading_register")->first();
            $isPermission = CommonFunction::checkPermission($permission->id);
            if(!$isPermission){
                return redirect("/dashboard")->with("error","permission not allowed for this module");
            }
             return $next($request);
        });
    }
    public function index(Request $request)
    {
        if($request->ajax()) {
            $sale_assets = MeterReading::orderBy('id', 'DESC')->select('*');
            if($request->month){
                 $sale_assets = $sale_assets->where("date","like",date("Y-m",strtotime("01-".$request->month))."%");
            }
            return DataTables::of($sale_assets)->addIndexColumn()->make(true);
        }
        $billOfMonth = MeterReading::orderBy("id","desc")->first();
        return view('admin.meter_reading.index',compact("billOfMonth"));
    }

    public function store(Request $request)
    {
        $inputs = $request->except('_token');
        // $inputs["date"] = date("Y-m-d",strtotime($request->date));
        $inputs["date"] = date("Y-m-d");
        if(MeterReading::create($inputs)){
            return redirect()->back()->with('message',config('constant.add_meter_reading'));
        }
        return redirect()->back()->with('error',config('constant.somthing_wrong'));
    }

    public function edit(string $id)
    {
        $meter_reading = MeterReading::find($id);
        $billOfMonth = MeterReading::orderBy("id","desc")->first();
        return response()->json(['meter_reading' => $meter_reading,"billOfMonth"=>$billOfMonth]);
    }

    public function update(Request $request, string $id)
    {
        $inputs = $request->except('_token','_method');
        // $inputs["date"] = date("Y-m-d",strtotime($request->date));
        if(MeterReading::where("id",$id)->update($inputs)) {
            return redirect()->back()->with('message',config('constant.update_meter_reading'));
        }
        return redirect()->back()->with('error',config('constant.somthing_wrong'));
    }

    public function destroy(string $id)
    {
        if(MeterReading::where("id",$id)->delete()) {
            // return response()->json()->with('message',config('constant.delete_sales_assets'));
            return response()->json(['message' => config('constant.delete_meter_reading')]);
        }
        return response()->json(['error' => config('constant.somthing_wrong')]);
    }

}
