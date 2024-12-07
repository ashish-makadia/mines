<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AssetCategroy;
use App\Models\MeterReading;
use App\Models\Mine;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MeterReadingController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            $sale_assets = MeterReading::orderBy('id', 'DESC')->select('*');
            return DataTables::of($sale_assets) ->addIndexColumn()->make(true);
        }
        $billOfMonth = MeterReading::orderBy("id","desc")->first();
        return view('admin.meter_reading.index',compact("billOfMonth"));
    }

    public function store(Request $request)
    {
        $inputs = $request->except('_token');
        $inputs["date"] = date("Y-m-d",strtotime($request->date));

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
        $inputs["date"] = date("Y-m-d",strtotime($request->date));
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
