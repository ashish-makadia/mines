<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DumperMachineRegister;
use App\Models\AssetCategroy;


use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class DumperMachineRegisterController extends Controller
{


    public function index(Request $request){
        $ac=AssetCategroy::get();
        // dd($ac);
        if($request->ajax()) {
            $data =DumperMachineRegister::with('assetcategroy')->orderBy('id', 'DESC')->select('*');


            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {


                return '<div class="d-flex action-btn-div">
               <a  href="javascript:void(0);" onclick="editfunc(' . $row['id'] . ')" class="btn btn-info btn-sm" > <i class="fas fa-pencil-alt"></i></a>

                &nbsp
                <a href="'.route('dumpermachine-register.delete', $row->id).'" class="btn btn-danger btn-sm">
                <i class="fas fa-trash"></i>
                </a>

            </div>';
            })
            ->addColumn('asset_id', function ($row) {
                if (!empty($row->assetcategroy->category_name)) {
                    return $row->assetcategroy->category_name;
                } else {
                    return '';
                }
            })

            ->rawColumns(['asset_id','action'])
                ->make(true);
        }
        return view('admin.dumpermachine_register.index',compact('ac'));
    }
    public function store(Request $request){

        $validator= validator::make($request->all(),
        [
            'start'=>'required',
        ]);
        if ($validator->fails()) {
            return  redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Validation failed! Please check the form and try again.');
        } else {

            $inputs = $request->except('_token');
            if(isset($request->dm_date)){
                $inputs["dm_date"] = date('Y-m-d', strtotime($request->dm_date));
               }
               DumperMachineRegister::create($inputs);

        }

         return redirect()->route('dumpermachine-register')->with('message',config('constant.add_dumpermachinereg'));
    }
    public function edit(Request $request)
    {
        $ac=AssetCategroy::get();

        $id = $request->id;
        $data = DumperMachineRegister::where('id', $id)->first();

        return response()->json(view('admin.dumpermachine_register.edit',compact('data','ac'))->render());
    }

    public function update(Request $request){

        $validator= validator::make($request->all(),
        [
            'start'=>'required',
        ]);
                  if($validator->fails()){
                    return redirect()->back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('error', 'Validation failed! Please check the form and try again.');
                }



                else{


            $inputs = $request->except('_token','_method');
            $inputs["updated_by"] =Auth::user()->id;
            if(isset($request->dm_date)){
                $inputs["dm_date"] = date('Y-m-d', strtotime($request->dm_date));
               }
               DumperMachineRegister::where("id",$request->editid)->update($inputs);

        }
         return redirect()->route('dumpermachine-register')->with('message',config('constant.update_dumpermachinereg'));
    }


    public function delete($id)
    {

        $data = DumperMachineRegister::find($id);
        $data ->deleted_by = Auth::user()->id;
        $data ->deleted_at = now();
        if ( $data ) {
            $data ->delete();
        }
        $data ->save();
        return redirect()->back()->with('message', config('constant.delete_dumpermachinereg'));
    }

}
