<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\CommonFunction;
use App\Models\DieselReport;
use App\Models\Employee;
use App\Models\ExpenseCategory;
use App\Models\ExpenseReport ;
use App\Models\Mine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class ExpenseReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $employees = Employee::get();
        $expensecategorys = ExpenseCategory::get();
        $mineId = Session::get("mine_id");
        $mine = Mine::find($mineId);
        $invoiceData = ExpenseReport::orderBy("id", "desc")->first();
        $lastId = $invoiceData->id??1;
        $invoiceNo = CommonFunction::getWipNo($lastId);
        if($mine){
            $invoiceNo = strtoupper(substr($mine->mine_name, 0, 4))."EXP".$invoiceNo;
        }
        if($request->ajax()) {
            $expense_report = ExpenseReport::with("categories","employees")->get();
            return DataTables::of($expense_report) ->addIndexColumn()->make(true);
        }
        return view('admin.reports.expense.list',compact("employees","expensecategorys","invoiceNo"));
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
        $inputs = $request->except("_token");
        $inputs["mine_id"] = Session::get("mine_id");
        $inputs["invoice_date"] = date("Y-m-d",strtotime($request->invoice_date));

        if ($request->hasFile('file')) {
            $file = $request->file;
            $filename = time().'_'.$file->getClientOriginalName();
            $destinationPath = public_path('/uploads/expense/');
            $file->move($destinationPath,$filename);
            $inputs['file'] = $filename;
        }

        if(ExpenseReport::create($inputs)){
            return redirect()->back()->with('message',config('constant.add_expense_report'));
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
        $expense_report = ExpenseReport::where('id', $id)->first();
        // return response()->json(view('admin.sale_assets.edit', compact('assetCategorys','assets_type','vendors','assign_assets'))->render());
        return response()->json(["expense_report"=>$expense_report]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $inputs = $request->except("_token","_method");
        $inputs["mine_id"] = Session::get("mine_id");
        $inputs["invoice_date"] = date("Y-m-d",strtotime($request->invoice_date));

        if ($request->hasFile('file')) {
            $file = $request->file;
            $filename = time().'_'.$file->getClientOriginalName();
            $destinationPath = public_path('/uploads/expense/');
            $file->move($destinationPath,$filename);
            $inputs['file'] = $filename;
        }

        if(ExpenseReport::where("id",$id)->update($inputs)){
            return redirect()->back()->with('message',config('constant.update_expense_report'));
        } else {
            return redirect()->back()->with('error', 'something went wrong please try again later.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(ExpenseReport::where("id",$id)->delete()) {
            return response()->json(['message' => config('constant.delete_expense_report')]);
        }
        return response()->json(['error' => config('constant.somthing_wrong')]);
    }
}
