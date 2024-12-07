<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Facades\Validator;
use Auth;
use DataTables;


class DepartmentController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $data=Department::orderBy('id','DESC')->select('*');
            return DataTables::of($data)
            ->addIndexColumn()
             ->addColumn('action', function ($row) {


                return '<div class="d-flex action-btn-div">
                
                <a  href="javascript:void(0);" onclick="editfunc(' . $row['id'] . ')" class="btn btn-info btn-sm" > <i class="fas fa-pencil-alt"></i></a>
                                                  
                &nbsp
                <a href="'.route('delete-department', $row->id).'" class="btn btn-danger btn-sm">
                <i class="fas fa-trash"></i>
                </a>
             
            </div>';
        })
        
        ->rawColumns(['action'])
        ->make(true);
        }
        return view('admin.department.index');
    }

    public function store(Request $request){
        
        $validator= validator::make($request->all(),
        [
            // 'designation'=> 'required',
            'department' => 'required|unique:designation_departments',
        ]);
        if($validator->fails()){
            return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('error', 'Validation failed! Please check the form and try again.');
        }
        else{
            $data=new Department();
            // $data->designation=$request->designation;
            $data->department=$request->department;
            $data->created_by=Auth::user()->id;
            $data->created_at= now();
            $data->save();

        }
         return redirect()->route('department')->with('message',config('constant.add_department'));
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $data = Department::where('id', $id)->first();

        return response()->json(view('admin.department.edit',compact('data'))->render());
    } 
   
    public function update(Request $request){
        
        $validator= validator::make($request->all(),
        [
            // 'designation'=> 'required',
            'department' => 'required',
        ]);
        if($validator->fails()){
            return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('error', 'Validation failed! Please check the form and try again.');
        }
        else{
            $data= Department::find($request->editid);
           
            // $data->designation=$request->designation;
            $data->department=$request->department;
            $data->updated_by=Auth::user()->id;
             $data->updated_at= now();
            $data->save();

        }
         return redirect()->route('department')->with('message',config('constant.update_department'));
    }
    public function delete($id)  
    {

        $data = Department::find($id);
        $data ->deleted_by = Auth::user()->id;
        $data ->deleted_at = now();
        if ( $data ) {
            $data ->delete();
        }
        $data ->save();
        return redirect()->back()->with('message', config('constant.delete_department'));
    }
}
