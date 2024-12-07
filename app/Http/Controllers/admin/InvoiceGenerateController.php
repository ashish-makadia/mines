<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Customer_Managment;
use App\Models\InvoiceGenerate;
use App\Models\Mine;
use App\Models\Quc;
use Spatie\Permission\Models\Permission;
use App\Http\Helpers\CommonFunction;
use Illuminate\Support\Facades\Auth ;
use App\Models\SellRegister;
use App\Models\Vendor_Managment;
use App\Models\Wip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class InvoiceGenerateController extends Controller
{
     public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $permission = Permission::where("name","invoice_generate")->first();
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
        $mine_id = Session::get("mine_id");
        if($request->ajax()) {
            $invoice_generate = InvoiceGenerate::with("customers","shippers","buyers")->where("mine_id", $mine_id)->orderBy('id', 'DESC')->select('*');
            return DataTables::of($invoice_generate) ->addIndexColumn()->make(true);
        }
        return view("admin.invoice-generate.list");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mine_id = Session::get("mine_id");
        $vendors = Vendor_Managment::get();
        $sell = SellRegister::with("wip")->where("mine_id", $mine_id)->get();
       
        $customers = Customer_Managment::get();
        $quc = Quc::get();
        $mines = Mine::get();

        $mineId = Session::get("mine_id");
        $mine = Mine::find($mineId);
        $invoiceData = InvoiceGenerate::orderBy("id", "desc")->first();
        $lastId = $invoiceData->id??1;
        $invoiceNo = CommonFunction::getWipNo($lastId);
        if($mine){
            $invoiceNo = strtoupper(substr($mine->mine_name, 0, 4))."".$invoiceNo;
        }

        return view("admin.invoice-generate.add",compact("mines","vendors","sell","customers","quc","invoiceNo"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $inputs = $request->except('_token');
        // dd($inputs);
        $inputs["mine_id"] = Session::get("mine_id");
        $inputs["ref_date"] = date('Y-m-d',strtotime($request->ref_date));
        $inputs["invoice_date"] = date('Y-m-d');
        $inputs["buy_date"] = date('Y-m-d',strtotime($request->buy_date));
        $inputs["delivery_date"] = date('Y-m-d',strtotime($request->delivery_date));
        $inputs["payment_status"] = "completed";
        if($request->remaining_amount > 0){
            $inputs["payment_status"] = "pending";
        }
        // dd($inputs);
        if($disaptch = InvoiceGenerate::create($inputs)) {
            return redirect()->route('invoice-generate')->with('message',config('constant.add_invoice_generate_register'));
        }
        return redirect()->back()->with('error',config('constant.somthing_wrong'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $invoice_generate = InvoiceGenerate::with("customers","shippers","buyers",'mines','wip')->find($id);
 $wip = $invoice_generate->wip->toArray();
//   dd($wip["sell_item"]);
        return view("admin.invoice-generate.print",compact("invoice_generate","wip"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $invoice_generate = InvoiceGenerate::find($id);
        $vendors = Vendor_Managment::get();
        $wip = Wip::get();
        $sell = SellRegister::with("wip")->get();
        $customers = Customer_Managment::get();
        $quc = Quc::get();
        $mines = Mine::get();
        return view("admin.invoice-generate.edit",compact("sell","invoice_generate","mines","vendors","wip","customers","quc"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $inputs = $request->except('_token','_method');
        $inputs["mine_id"] = Session::get("mine_id");
        $inputs["ref_date"] = date('Y-m-d',strtotime($request->ref_date));
        $inputs["invoice_date"] = date('Y-m-d');
        $inputs["buy_date"] = date('Y-m-d',strtotime($request->buy_date));
        $inputs["delivery_date"] = date('Y-m-d',strtotime($request->delivery_date));
        $inputs["payment_status"] = "completed";

        if($request->remaining_amount > 0){
            $inputs["payment_status"] = "pending";
        }
        if(InvoiceGenerate::where("id",$id)->update($inputs)) {
            return redirect()->route('invoice-generate')->with('message',config('constant.update_invoice_generate_register'));
        }
        return redirect()->back()->with('error',config('constant.somthing_wrong'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(InvoiceGenerate::where("id",$id)->delete()) {
            return response()->json(['message' => config('constant.delete_invoice_generate_reading')]);
        }
        return response()->json(['error' => config('constant.somthing_wrong')]);
    }
    public function getInvoicePyament($id){
        $invoice_generate = InvoiceGenerate::find($id);
        $invoice = InvoiceGenerate::get();
        return view("admin.invoice-generate.payment",compact("invoice_generate","invoice"));
    }

    public function updatePayment(Request $request, string $id)
    {
        $inputs = $request->except('_token');
        $inputs["pay_amount"] = $request->total_amount-$request->remaining_amount;
        $inputs["payment_status"] = "completed";
        if($request->remaining_amount > 0){
            $inputs["payment_status"] = "pending";
        }
        if(InvoiceGenerate::where("id",$id)->update($inputs)) {
            return redirect()->route('invoice-generate')->with('message',config('constant.update_invoice_generate_register'));
        }
        return redirect()->back()->with('error',config('constant.somthing_wrong'));
    }
}
