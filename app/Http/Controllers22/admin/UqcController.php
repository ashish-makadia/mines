<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quc;
use DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UqcController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {

            $mine = Quc::orderBy('id', 'DESC')->select('*');

            return Datatables::of($mine)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {


                    return '<div class="d-flex action-btn-div">
                   
                    <a  href="javascript:void(0);" class="btn btn-info btn-sm"    onclick="editquc(' . $row['id'] . ')"> <i class="fas fa-pencil-alt"></i></a>
                                                    
                    &nbsp
                    <a href="' . route('quc-delete-managment', $row->id) . '" class="btn btn-danger btn-sm">
                    <i class="fas fa-trash"></i>
                    </a>
                 
                </div>';
                })


                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.uqc.index');
    }


    public function store(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'uqc_code' => 'required',

        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Validation failed! Please check the form and try again.');
        } else {

            $quc = new  Quc();
            $quc->uqc_code = $request->uqc_code;
            $quc->created_by = Auth::user()->id;
            $quc->save();

            return redirect()->back()->with('message', config('constant.add_quc'));
        }
    }


    public function edit(Request $request)
    {
        $id = $request->id;
        $uqc = Quc::where('id', $id)->first();

        return response()->json(view('admin.uqc.edit', compact('uqc'))->render());
    }


    public function update(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'uqc_code' => 'required',

        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Validation failed! Please check the form and try again.');
        } else {

            $quc =   Quc::find($request->editid);
            $quc->uqc_code = $request->uqc_code;
            $quc->created_by = Auth::user()->id;
            $quc->save();

            return redirect()->back()->with('message', config('constant.update_quc'));
        }
    }

    public function delete($id)
    {

        $quc = Quc::find($id);
        $quc->deleted_by = Auth::user()->id;
        $quc->deleted_at = now();
        if ($quc) {
            $quc->delete();
        }
        $quc->save();
        return redirect()->back()->with('message', config('constant.delete_quc'));
    }
}
