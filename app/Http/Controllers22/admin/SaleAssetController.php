<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AssetCategroy;
use App\Models\AssetsStock;
use App\Models\Machinary_assets_list;
use App\Models\Mine;
use App\Models\Sale_Assets;
use App\Models\Vendor_Managment;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SaleAssetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $assets_type = Config("constantArr.assetsType");
        $assetCategorys = AssetCategroy::get();
        $vendors = Vendor_Managment::get();
        $mines = Mine::get();
        if($request->ajax()) {
            $sale_assets =Sale_Assets::with('assetscategory','mines','transferMines')->orderBy('id', 'DESC')->select('*');
            return DataTables::of($sale_assets) ->addIndexColumn()->make(true);
        }
        return view('admin.sale_assets.index',compact('assets_type',"assetCategorys","vendors","mines"));
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
        $inputs["sales_date"] = date("Y-m-d",strtotime($request->sales_date));
       
        if($sales_assets = Sale_Assets::create($inputs)) {
            AssetsStock::create([
                "working_assets" =>  $request->assets_category,
                "item_name" => $request->assets_name,
                "quantity" =>$request->quantity,
                "type" => "sale",
                "sale_id" => $sales_assets->id,
            ]);
            return redirect()->back()->with('message',config('constant.add_sales_assets'));
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
        $assets_type = Config("constantArr.assetsType");
        $assetCategorys = AssetCategroy::get();
        $vendors = Vendor_Managment::get();
        // $mines = Mine::get();
        $assign_assets = Sale_Assets::where('id', $id)->first();
        // return response()->json(view('admin.sale_assets.edit', compact('assetCategorys','assets_type','vendors','assign_assets'))->render());
        return response()->json(["assign_assets"=>$assign_assets]);
    }

    public function getAssetsName(Request $request){
       $machineryAssets = Machinary_assets_list::where("asset_category_id",$request->category)->orderBy("id","desc")->first();
       return response()->json(["machineryAssets"=>$machineryAssets]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $inputs = $request->except('_token','_method');
        $inputs["sales_date"] = date("Y-m-d",strtotime($request->sales_date));
          
        if(Sale_Assets::where("id",$id)->update($inputs)) {
            AssetsStock::where("sale_id",$id)->update([
                "working_assets" =>  $request->assets_category,
                "item_name" => $request->assets_name,
                "quantity" =>$request->quantity,
                "type" => "purchase",
            ]);
            
            return redirect()->back()->with('message',config('constant.update_sales_assets'));
        }
        return redirect()->back()->with('error',config('constant.somthing_wrong'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(Sale_Assets::where("id",$id)->delete()) {
            // return response()->json()->with('message',config('constant.delete_sales_assets'));
            return response()->json(['message' => config('constant.delete_sales_assets')]);
        }
        return response()->json(['error' => config('constant.somthing_wrong')]);
    }
}
