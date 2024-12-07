<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Designation;
use App\Models\Department;

use DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class DesignationController extends Controller
{
    

    public function index(Request $request){
        $depar=Department::get();
        if($request->ajax()) {
            $data =Designation::with('department')->orderBy('id', 'DESC')->select('*');
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {


                return '<div class="d-flex action-btn-div">
               <a  href="javascript:void(0);" onclick="editfunc(' . $row['id'] . ')" class="btn btn-info btn-sm" > <i class="fas fa-pencil-alt"></i></a>
                                                  
                &nbsp
                <a href="'.route('delete-designation', $row->id).'" class="btn btn-danger btn-sm">
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
            
            ->rawColumns(['depart_id','action'])
                ->make(true);
        }
        return view('admin.designation.index',compact('depar'));
    }
    public function store(Request $request){
        
        $validator= validator::make($request->all(),
        [
            'depart_id'=>'required',
        'designation'=> 'required',
           
        ]);
        if($validator->fails()){
            return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('error', 'Validation failed! Please check the form and try again.');
        }
        $existingAssignment = Designation::where('depart_id', $request->depart_id)
        ->where('designation', $request->designation)
        ->exists();

    if ($existingAssignment) {
        return redirect()->back()->with('error', 'Validation failed! Please check the form and try again.')->withErrors(['message' => 'Department & Designation exitsts']);
           
    }
        else{
            $data=new Designation();
            $data->depart_id=$request->depart_id;
            $data->designation=$request->designation;
            $data->created_by=Auth::user()->id;
            $data->created_at= now();
            $data->save();

        }
         return redirect()->route('designation')->with('message',config('constant.add_designation'));
    }
    public function edit(Request $request)
    {   
        $depar=Department::get();
        $id = $request->id;
        $data = Designation::where('id', $id)->first();

        return response()->json(view('admin.designation.edit',compact('data','depar'))->render());
    } 
   
    public function update(Request $request){
        
        $validator= validator::make($request->all(),
        [
            'depart_id'=>'required',
            'designation'=> 'required',
        ]);
                  if($validator->fails()){
                    return redirect()->back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('error', 'Validation failed! Please check the form and try again.');
                }
                $existingAssignment = Designation::where('id','!=',$request->editid)->where('depart_id', $request->depart_id)
                ->where('designation', $request->designation)
                ->exists();
        
            if ($existingAssignment) {
                return redirect()->back()->with('error', 'Validation failed! Please check the form and try again.')->withErrors(['message' => 'Department & Designation exitsts']);
                   
            }
                else{
            $data= Designation::find($request->editid);
           
            $data->depart_id=$request->depart_id;
            $data->designation=$request->designation;
            $data->updated_by=Auth::user()->id;
             $data->updated_at= now();
            $data->save();

        }
         return redirect()->route('designation')->with('message',config('constant.update_designation'));
    }


    public function delete($id)  
    {

        $data = Designation::find($id);
        $data ->deleted_by = Auth::user()->id;
        $data ->deleted_at = now();
        if ( $data ) {
            $data ->delete();
        }
        $data ->save();
        return redirect()->back()->with('message', config('constant.delete_designation'));
    }

}
