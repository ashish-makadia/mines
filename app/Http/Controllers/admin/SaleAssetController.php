<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AssetCategroy;
use App\Models\AssetsStock;
use Spatie\Permission\Models\Permission;
use App\Http\Helpers\CommonFunction;
use Illuminate\Support\Facades\Auth ;
use App\Models\Machinary_assets_list;
use App\Models\Mine;
use App\Models\Sale_Assets;
use App\Models\Vendor_Managment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class SaleAssetController extends Controller
{
     public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $permission = Permission::where("name","assets_stock")->first();
            $isPermission = CommonFunction::checkPermission($permission->id);
            if(!$isPermission){
                return redirect("/dashboard")->with("error","permission not allowed for this module");
            }
             return $next($request);
        });
    }
    /**k
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $assets_type = Config("constantArr.assetsType");
        $assetCategorys = AssetCategroy::get();
        $vendors = Vendor_Managment::get();
        $mines = Mine::get();
        $mineId = Session::get("mine_id");
        if($request->ajax()) {
            $sale_assets =Sale_Assets::with('assetscategory','mines','transferMines','assets')->orderBy('id', 'DESC')->select('*');
            return DataTables::of($sale_assets) ->addIndexColumn()->make(true);
        }

        return view('admin.sale_assets.index',compact('mineId','assets_type',"assetCategorys","vendors","mines"));
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
 $inputs["mine_id"] =Session::get("mine_id");
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
        $mineId = Session::get("mine_id");
        // $mines = Mine::get();
        $assign_assets = Sale_Assets::where('id', $id)->first();

        // return response()->json(view('admin.sale_assets.edit', compact('assetCategorys','assets_type','vendors','assign_assets'))->render());
        return response()->json(["assign_assets"=>$assign_assets]);
    }

    public function getAssetsName(Request $request){
       $machineryAssets = Machinary_assets_list::where("asset_category_id",$request->category)->get();
       return response()->json(["machineryAssets"=>$machineryAssets]);
    }
    public function getAssetsData(Request $request){
        // $machineryAssets = Machinary_assets_list::where("id",$request->id)->first();
        // $stockItems = AssetsStock::with('assets')
        // ->select(
        //     'item_name',
        //     'working_assets',
        //     // DB::raw('SUM(CASE WHEN type = "purchase" THEN quantity WHEN type = "sale" THEN -quantity ELSE 0 END) as remaining_quantity')
        // )->groupBy('item_name', 'working_assets')->where("item_name",$request->id)->get();
        $stockItems = AssetsStock::with('workingAssets')
        ->select(
            'item_name',
            'working_assets',
            DB::raw('SUM(CASE WHEN type = "purchase" THEN quantity ELSE 0 END) as total_purchase_quantity'),
            DB::raw('SUM(CASE WHEN type = "sale" THEN quantity ELSE 0 END) as total_sale_quantity'),
            DB::raw('SUM(CASE WHEN type = "purchase" THEN quantity WHEN type = "sale" THEN -quantity ELSE 0 END) as remaining_quantity')
        )
        ->groupBy('item_name', 'working_assets')->where("item_name",$request->id)->first();
        return response()->json(["machineryAssets"=>$stockItems]);
     }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $inputs = $request->except('_token','_method');
        $inputs["sales_date"] = date("Y-m-d",strtotime($request->sales_date));
        $inputs["mine_id"] =Session::get("mine_id");
        if(Sale_Assets::where("id",$id)->update($inputs)) {
            AssetsStock::where("sale_id",$id)->update([
                "working_assets" =>  $request->assets_category,
                "item_name" => $request->assets_name,
                "quantity" =>$request->quantity,
                "type" => "sale",
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
            AssetsStock::where("sale_id" ,$id)->delete();
            // return response()->json()->with('message',config('constant.delete_sales_assets'));
            return response()->json(['message' => config('constant.delete_sales_assets')]);
        }
        return response()->json(['error' => config('constant.somthing_wrong')]);
    }
}
