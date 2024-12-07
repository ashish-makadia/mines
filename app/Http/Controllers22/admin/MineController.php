<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\State;
use App\Models\City;
use App\Models\Mine;
use App\Models\Unit;
use App\Models\Quc;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class MineController extends Controller
{

    public function list(Request $request)
    {


        if ($request->ajax()) {

            $mine = Mine::with('state', 'city')->orderBy('id', 'DESC')->select('*');

            return DataTables::of($mine)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {


                    return '<div class="d-flex action-btn-div">
                    <a class="btn btn-primary btn-sm" href="#"  data-toggle="modal" data-target="#response" title="View">
                                                        <i class="fas fa-eye"></i></a> &nbsp
                    <a  href="' . route('edit-mine', $row->id) . '" class="btn btn-info btn-sm" > <i class="fas fa-pencil-alt"></i></a>

                    &nbsp
                    <a href="' . route('delete-mine', $row->id) . '" class="btn btn-danger btn-sm">
                    <i class="fas fa-trash"></i>
                    </a>

                </div>';
                })

                ->addColumn('state_id', function ($row) {
                    if (!empty($row->state->name)) {
                        return $row->state->name;
                    } else {
                        return '';
                    }
                })

                ->addColumn('city_id', function ($row) {
                    if (!empty($row->city->name)) {
                        return $row->city->name;
                    } else {
                        return '';
                    }
                })

                ->addColumn('mine_purchase_date', function ($row) {
                    return date('d-m-Y', strtotime($row->mine_purchase_date));
                })

                ->rawColumns(['mine_purchase_date', 'state_id', 'city_id', 'action'])
                ->make(true);
        }

        return view('admin.mine.list');
    }

    public function add()
    {
        // $units = Unit::get();
         $qucs = Quc::get();
        // dd($units);
        $states = State::get();
        return view('admin.mine.add', compact('states','qucs'));
    }

    public function store(Request $request)
    {
                $validator = Validator::make($request->all(), [
            'mine_name' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
            'mine_purchase_date' => 'required',
            'mine_email' => 'required|email|unique:mines,mine_email', // Add table name 'minedatas' here
            'mine_contact' => ['required', 'regex:/^\d{10}$/'],
            'address' => 'nullable|string',
             // Assuming this field is optional
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Validation failed! Please check the form and try again.');
        } else {
            $minedata = new Mine();
            $minedata->mine_name = $request->mine_name;
            $minedata->mine_area = $request->mine_area;
            $minedata->area_unit = $request->area_unit;
            $minedata->mine_contact = $request->mine_contact;
            $minedata->mine_email = $request->mine_email;
            $minedata->state_id = $request->state_id;
            $minedata->city_id = $request->city_id;
            $minedata->gps_location = $request->gps_location;
            $minedata->address = $request->address;
                $minedata->mine_purchase_date = date('Y-m-d', strtotime($request->mine_purchase_date));
            $minedata->created_by = Auth::user()->id;
            $minedata->save();

            return redirect()->route('mine')->with('message',config('constant.add_mine'));
        }
    }




    public function edit($id)
    {
        $qucs = Quc::get();
        $states = State::get();
        $mine = Mine::where('id', $id)->first();
        return view('admin.mine.edit', compact('states', 'mine','qucs'));
    }


    public function update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'mine_name' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
            'mine_email' => 'required', // Add table name 'minedatas' here
            'mine_contact' => ['required', 'regex:/^\d{10}$/'],
            'address' => 'nullable|string',
            'mine_purchase_date' => 'required', // Assuming this field is optional
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Validation failed! Please check the form and try again.');
        } else {
            $minedata =  Mine::find($request->editid);
            $minedata->mine_name = $request->mine_name;
            $minedata->mine_area = $request->mine_area;
            $minedata->area_unit = $request->area_unit;
            $minedata->mine_contact = $request->mine_contact;
            $minedata->mine_email = $request->mine_email;
            $minedata->state_id = $request->state_id;
            $minedata->city_id = $request->city_id;
            $minedata->gps_location = $request->gps_location;
            $minedata->address = $request->address;
            $minedata->mine_purchase_date = date('Y-m-d', strtotime($request->mine_purchase_date));
            $minedata->updated_by = Auth::user()->id;
            $minedata->save();

            return redirect()->route('mine')->with('message',config('constant.update_mine'));
        }
    }


    public function delete($id)
    {
        $mine = Mine::find($id);
        $mine->deleted_by =  Auth::user()->id;
        $mine->deleted_at =  now();
        if ( $mine) {
            $mine->delete();
         }
         $mine->save();
         return redirect()->route('mine')->with('message',config('constant.delete_mine'));
    }
    public function getCity(Request $request)
    {
        $city_ajax = City::where('state_id', $request->state_id)->get();
        return response()->json($city_ajax);
    }
}
