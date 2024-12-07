<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Volume;
use Illuminate\Support\Facades\Validator;
use Auth;
use DataTables;


class VolumeController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $data=Volume::orderBy('id','DESC')->select('*');
            return DataTables::of($data)
            ->addIndexColumn()
             ->addColumn('action', function ($row) {


                return '<div class="d-flex action-btn-div">
                
                <a  href="javascript:void(0);" onclick="editfunc(' . $row['id'] . ')" class="btn btn-info btn-sm" > <i class="fas fa-pencil-alt"></i></a>
                                                  
                &nbsp
                <a href="'.route('volume.delete', $row->id).'" class="btn btn-danger btn-sm">
                <i class="fas fa-trash"></i>
                </a>
             
            </div>';
        })
        
        ->rawColumns(['action'])
        ->make(true);
        }
        return view('admin.volume.index');
    }

    public function store(Request $request){
        
        $validator= validator::make($request->all(),
        [
            // 'designation'=> 'required',
            'volume' => 'required',
        ]);
        if($validator->fails()){
            return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('error', 'Validation failed! Please check the form and try again.');
        }
        else{
            $data=new Volume();
            // $data->designation=$request->designation;
            $data->volume=$request->volume;
            $data->created_by=Auth::user()->id;
            $data->created_at= now();
            $data->save();

        }
         return redirect()->route('volume')->with('message',config('constant.add_department'));
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $data = Volume::where('id', $id)->first();

        return response()->json(view('admin.volume.edit',compact('data'))->render());
    } 
   
    public function update(Request $request){
        
        $validator= validator::make($request->all(),
        [
            // 'designation'=> 'required',
            'volume' => 'required',
        ]);
        if($validator->fails()){
            return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('error', 'Validation failed! Please check the form and try again.');
        }
        else{
            $data= Volume::find($request->editid);
           
            // $data->designation=$request->designation;
            $data->volume=$request->volume;
            $data->updated_by=Auth::user()->id;
             $data->updated_at= now();
            $data->save();

        }
         return redirect()->route('volume')->with('message',config('constant.update_volume'));
    }
    public function delete($id)  
    {

        $data = Volume::find($id);
        $data ->deleted_by = Auth::user()->id;
        $data ->deleted_at = now();
        if ( $data ) {
            $data ->delete();
        }
        $data ->save();
        return redirect()->back()->with('message', config('constant.delete_volume'));
    }
}
