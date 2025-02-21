<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AssetCategroy;
use App\Models\DieselStock;
use App\Models\DispatchRegister;
use App\Models\Vendor_Managment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class DieselStockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $assetCategorys = AssetCategroy::get();
        $vendors = Vendor_Managment::get();
        if($request->ajax()) {
            $diesel_stock = DieselStock::with("assetscategory","vendor")->orderBy('id', 'DESC')->select('*');
            return DataTables::of($diesel_stock) ->addIndexColumn()->make(true);
        }
        return view('admin.diesel_stock.index',compact("assetCategorys","vendors"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'capacity_storage' => 'required',
            'stock' => 'required',
            'rate_per_ltr' => 'required',
            'vendor_id' => 'required',
        ]);
       
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Validation failed! Please check the form and try again.');
        } else {
            $inputs = $request->except('_token');
            $inputs["date"] = date('Y-m-d', strtotime($request->date));
            if(DieselStock::create($inputs)) {
                return redirect()->back()->with('message',config('constant.add_diesel_stock'));
            }
            return redirect()->back()->with('error',config('constant.somthing_wrong'));
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
        $assetCategorys = AssetCategroy::get();
        $vendors = Vendor_Managment::get();
        // $mines = Mine::get();
        $diesel_stock = DieselStock::where('id', $id)->first();
        // return response()->json(view('admin.sale_assets.edit', compact('assetCategorys','assets_type','vendors','assign_assets'))->render());
        return response()->json(["diesel_stock"=>$diesel_stock]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {


        $validator = Validator::make($request->all(), [
            'capacity_storage' => 'required',
            'stock' => 'required',
            'rate_per_ltr' => 'required',
            'vendor_id' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Validation failed! Please check the form and try again.');
        } else {
            $inputs = $request->except('_token','_method');
            $inputs["date"] = date('Y-m-d', strtotime($request->date));
            if(DieselStock::where("id", $id)->update($inputs)) {
                return redirect()->back()->with('message',config('constant.update_diesel_stock'));
            }
            return redirect()->back()->with('error',config('constant.somthing_wrong'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(DieselStock::where("id",$id)->delete()) {
            // return response()->json()->with('message',config('constant.delete_sales_assets'));
            return response()->json(['message' => config('constant.delete_diesel_stock')]);
        }
        return response()->json(['error' => config('constant.somthing_wrong')]);
    }
}
