<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Quc;
use App\Models\SellRegister;
use App\Models\User;
use App\Models\Vendor_Managment;
use Spatie\Permission\Models\Permission;
use App\Http\Helpers\CommonFunction;
use Illuminate\Support\Facades\Auth ;
use App\Models\Wip;
use App\Models\wipSellItem;
use App\Models\WipStock;
use App\Models\WorkInProgressStep3;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class SellRegisterController extends Controller
{
     public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $permission = Permission::where("name","sell_register")->first();
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
        $mine_id = Session::get("mine_id");

        $wip = Wip::where("mine_id",$mine_id)->get();
        $users = User::get();
        $quc = Quc::get();
        if($request->ajax()) {
            $sell_register = SellRegister::with("wip","parties","users","quc")->where("mine_id",$mine_id)->orderBy('id', 'DESC');
            return DataTables::of($sell_register)->addIndexColumn()->make(true);
        }
        return view('admin.sell_register.index',compact("wip","vendors","users","quc"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vendors = Vendor_Managment::get();
        $mine_id = Session::get("mine_id");

        $wip = Wip::where("mine_id",$mine_id)->get();
        $users = User::get();
        $quc = Quc::get();

        return view('admin.sell_register.create',compact("wip","vendors","users","quc"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $inputs = $request->except('_token',"item_id","sellQty","total_item_qty","sell_item_qty","rem_item_qty");
        $inputs["mine_id"] = Session::get("mine_id");
        // dd($request->all());
        if($disaptch = SellRegister::create($inputs)) {
            foreach ($request->item_id as $key => $value) {
                wipSellItem::create([
                    'sell_id' => $disaptch->id,
                    'item_id' => $value,
                    'wip_id' => $request->wip_no,
                    'Qty' => $request->total_item_qty[$key]??0,
                    'sellQty' => $request->sell_item_qty[$key]??0,
                    'remQty' => $request->rem_item_qty[$key]??0
                ]);
            }
            return redirect("sell-register")->with('message',config('constant.add_sell_register'));
        }
        return redirect("sell-register")->with('error',config('constant.somthing_wrong'));
    }

     public function getSellAmount(Request $request){
        $sell_register = SellRegister::find($request->id);
        return response()->json($sell_register);
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
        $vendors = Vendor_Managment::get();
        $mine_id = Session::get("mine_id");

        $wip = Wip::where("mine_id",$mine_id)->get();
        $users = User::get();
        $quc = Quc::get();
        $sell_register = SellRegister::with("sellItem")->find($id);
        // dd($sell_register);
        return view('admin.sell_register.edit',compact("sell_register","wip","vendors","users","quc"));

        // // $vendors = Vendor_Managment::get();
        // // $wip = Wip::get();
        // // $users = User::get();
        // // $quc = Quc::get();
        // $sell_register = SellRegister::with("sellItem")->find($id);
        // // return response()->json(view('admin.sell_register.edit', compact('sell_register','wip','vendors','users','quc'))->render());
        // return response()->json(["sell_register" => $sell_register]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $inputs = $request->except('_token','_method',"sell_item_id","item_id","sellQty","total_item_qty","sell_item_qty","rem_item_qty");
        if($disaptch = SellRegister::where("id",$id)->update($inputs)) {
            foreach ($request->item_id as $key => $value) {
                wipSellItem::where("id",$request->sell_item_id[$key])->update([
                    'sell_id' => $id,
                    'item_id' => $value,
                    'wip_id' => $request->wip_no,
                    'Qty' => $request->total_item_qty[$key]??0,
                    'sellQty' => $request->sell_item_qty[$key]??0,
                    'remQty' => $request->rem_item_qty[$key]??0
                ]);
            }
            return redirect()->back()->with('message',config('constant.update_sell_register'));
        }
        return redirect()->back()->with('error',config('constant.somthing_wrong'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(SellRegister::where("id",$id)->delete()) {
            return response()->json(['message' => config('constant.delete_sell_register')]);
        }
        return response()->json(['error' => config('constant.somthing_wrong')]);
    }

    public function getStock(Request $request){
        $wip = WorkInProgressStep3::with("wip_stock")->where("wip_id",$request->wipId)->get();
        $wipObj = $wip->map(function($wipItem){
            $sellQty = wipSellItem::where("item_id",$wipItem->id)->sum("sellQty");
            $remQty = $wipItem->no_of_pieces - $sellQty ;
            \Log::info($wipItem->no_of_pieces." ".$sellQty);
            $wipItem['remQty'] = $remQty;
            return $wipItem;
         });
        $stockItems = WorkInProgressStep3::where("wip_id",$request->wipId)
            ->sum("no_of_pieces");
            // dd($wip);
        $sellQty = SellRegister::where("wip_no",$request->wipId)->sum("sell_qty");
        $rem_qty = $stockItems - $sellQty;
        return response()->json(['status' => true,'data'=>$rem_qty>0?$rem_qty:0,'wip'=> $wipObj]);
    }
    public function viewStock($id){
       $sellItem = wipSellItem::with("wip_step3")->where("item_id",$id)->get();
    //    dd($sellItem);
       return response()->json(view('admin.sell_register.view_stock', compact('sellItem'))->render());
    }
}
