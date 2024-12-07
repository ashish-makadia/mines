<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use App\Http\Helpers\CommonFunction;
use Illuminate\Support\Facades\Auth ;
use App\Models\Employee;
use App\Models\EmployeeSalary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class EmployeeSalaryController extends Controller
{
     public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $permission = Permission::where("name","employee_management")->first();
            $isPermission = CommonFunction::checkPermission($permission->id);
            if(!$isPermission){
                return redirect("/dashboard")->with("error","permission not allowed for this module");
            }
             return $next($request);
        });
    }
    public function index(Request $request)
    {
        $employees = Employee::get();
        if($request->ajax()) {
            $employee_salary = EmployeeSalary::with("employees")->orderBy('id', 'DESC')->select('*');
            return DataTables::of($employee_salary)->addIndexColumn()->make(true);
        }
        return view('admin.reports.employee_salary.index',compact("employees"));
    }
    public function getEmployeeSalary (Request $request){
        $employee = Employee::find($request->id);
        $paidAmount = EmployeeSalary::select(DB::raw('SUM("payment_amount") as paidAmount'))->where("employee_id",$request->id)
        ->where("payment_date","like",date("Y-m",strtotime($request->date))."%")->sum("payment_amount");

        $dieselStockArr["total_amount"] = $employee->salary-$paidAmount;
        $dieselStockArr["total_salary"] = $employee->salary;
        return response()->json($dieselStockArr);
    }

    public function store(Request $request){
        $inputs = $request->except("_token");
        $inputs["mine_id"] = Session::get("mine_id");
        $inputs["payment_date"] = date("Y-m-d");

        if(EmployeeSalary::create($inputs)){
            return redirect()->back()->with('message',config('constant.add_employee_salary_report'));
        } else {
            return redirect()->back()->with('error', 'something went wrong please try again later.');
        }
    }
    public function edit(string $id)
    {
        $employee_salary = EmployeeSalary::with("employees")->where('id', $id)->first();
        return response()->json(["employee_salary"=>$employee_salary]);
    }
    public function update(Request $request,$id){
        $inputs = $request->except("_token","_method");
        $inputs["mine_id"] = Session::get("mine_id");
        $inputs["payment_date"] = date("Y-m-d");

        if(EmployeeSalary::where("id",$id)->update($inputs)){
            return redirect()->back()->with('message',config('constant.update_employee_salary_report'));
        } else {
            return redirect()->back()->with('error', 'something went wrong please try again later.');
        }
    }

    public function destroy(string $id)
    {
        if(EmployeeSalary::where("id",$id)->delete()) {
            return response()->json(['message' => config('constant.delete_employee_salary')]);
        }
        return response()->json(['error' => config('constant.somthing_wrong')]);
    }
}
