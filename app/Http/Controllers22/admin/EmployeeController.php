<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Designation;
use App\Models\Department;

use App\Models\Employee;
use DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    

    public function index(Request $request){
        $depar=Department::get();
        // dd($depar);
        $desig=Designation::get();
        // dd($desig);
        if($request->ajax()) {
            $data =Employee::with('department','designation')->orderBy('id', 'DESC')->select('*');
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {


                return '<div class="d-flex action-btn-div">
               <a  href="javascript:void(0);" onclick="editfunc(' . $row['id'] . ')" class="btn btn-info btn-sm" > <i class="fas fa-pencil-alt"></i></a>
                                                  
                &nbsp
                <a href="'.route('employee.delete', $row->id).'" class="btn btn-danger btn-sm">
                <i class="fas fa-trash"></i>
                </a>
             
            </div>';
            })
            ->addColumn('depart_id', function ($row) {
                if (!empty($row->department->department)) {
                    return $row->department->department;
                } else {
                    return '';
                }
            })
            ->addColumn('designation_id', function ($row) {
                if (!empty($row->designation->designation)) {
                    return $row->designation->designation;
                } else {
                    return '';
                }
            })
            ->rawColumns(['depart_id','designation_id','action'])
                ->make(true);
        }
        return view('admin.employee.index',compact('depar','desig'));
    }
    public function store(Request $request){
        
        $validator= validator::make($request->all(),
        [
            'name'=>'required',
        ]);
        if ($validator->fails()) {
            return  redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Validation failed! Please check the form and try again.');
        } else {

            $employee = new Employee();
            $employee->name = $request->input('name');
            if(isset($request->joining_date)){
                $employee->joining_date = date('Y-m-d', strtotime($request->joining_date));
               }
           
               $employee->salary = $request->input('salary');
               
            $employee->pf = $request->input('pf');
            $employee->number = $request->input('number');
            $employee->email = $request->input('email');
          $employee->depart_id = $request->input('depart_id');
            $employee->designation_id = $request->input('designation_id');
            $employee->created_by = Auth::user()->id;
           
            $employee->save();
        }

         return redirect()->route('employee')->with('message',config('constant.add_employee'));
    }
    public function edit(Request $request)
    {   
        $depar=Department::get();
        $desig=Designation::get();
        
        $id = $request->id;
        $data = Employee::where('id', $id)->first();

        return response()->json(view('admin.employee.edit',compact('data','depar','desig'))->render());
    } 
   
    public function update(Request $request){
        
        $validator= validator::make($request->all(),
        [
            'name'=>'required',
        ]);
                  if($validator->fails()){
                    return redirect()->back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('error', 'Validation failed! Please check the form and try again.');
                }
               
        
           
                else{
            $data= Employee::find($request->editid);
           
          
           

            $data->name=$request->name;
            $data->number=$request->number;
            $data->email=$request->email;
            $data->salary=$request->salary;
            $data->pf=$request->pf;
            if(isset($request->joining_date)){
                $data->joining_date = date('Y-m-d', strtotime($request->joining_date));
               }
            // dd($data->joining_date);
            $data->depart_id=$request->depart_id;
            $data->designation_id=$request->designation_id;
            $data->updated_by=Auth::user()->id;
             $data->updated_at= now();
            $data->save();

        }
         return redirect()->route('employee')->with('message',config('constant.update_employee'));
    }


    public function delete($id)  
    {

        $data = Employee::find($id);
        $data ->deleted_by = Auth::user()->id;
        $data ->deleted_at = now();
        if ( $data ) {
            $data ->delete();
        }
        $data ->save();
        return redirect()->back()->with('message', config('constant.delete_employee'));
    }

}
