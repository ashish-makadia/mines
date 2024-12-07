<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AssetCategroy;
use App\Models\Vendor_Managment;
use App\Models\Quc;
use App\Models\Machinary_assets_list;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use DataTables;

class Machinaryassetlist extends Controller
{
    public function list(Request $request)
    {
        if ($request->ajax()) {

            $mine = Machinary_assets_list::with('vendore', 'uqc', 'category')->orderBy('id', 'DESC')->select('*');

            return Datatables::of($mine)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {


                    return '<div class="d-flex action-btn-div">
                    <a class="btn btn-primary btn-sm" href="javascript:void(0);"  onclick="viewdata(' . $row['id'] . ')" title="View">
                                                        <i class="fas fa-eye"></i></a> &nbsp
                    <a  href="' . route('mine-machinary-assets-edit-managment', $row->id) . '" class="btn btn-info btn-sm" > <i class="fas fa-pencil-alt"></i></a>
                                                    
                    &nbsp
                    <a href="' . route('mine-machinary-assets-delete-managment', $row->id) . '" class="btn btn-danger btn-sm">
                    <i class="fas fa-trash"></i>
                    </a>
                 
                </div>';
                })

                ->addColumn('vendor_id', function ($row) {
                    if (!empty($row->vendore->vendor_name)) {
                        return $row->vendore->vendor_name;
                    } else {
                        return '';
                    }
                })

                ->addColumn('uqc_id', function ($row) {
                    if (!empty($row->uqc->uqc_code)) {
                        return $row->uqc->uqc_code;
                    } else {
                        return '';
                    }
                })

                ->addColumn('asset_category_id', function ($row) {
                    if (!empty($row->category->category_name)) {
                        return $row->category->category_name;
                    } else {
                        return '';
                    }
                })

                ->addColumn('date_of_purchase', function ($row) {
                    return date('d-m-Y', strtotime($row->date_of_purchase));
                })

                ->rawColumns(['date_of_purchase', 'warranty_expiration', 'vendor_id', 'uqc_id', 'asset_category_id', 'action'])
                ->make(true);
        }

        return view('admin.machinary_and_assets_list.list');
    }


    public function add()
    {
        $assetCategorys = AssetCategroy::get();
        $vendors = Vendor_Managment::get();
        $qucs = Quc::get();
        return view('admin.machinary_and_assets_list.add', compact('assetCategorys', 'vendors', 'qucs'));
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'owner_name' => 'required',
            'asset_category_id' => 'required',
            'machine_name' => 'required',
            'machine_qty' => 'required',
            'model_number' => 'required',
            'achine_asset_price' => 'required',
            'tax_rate' => 'required',
            'total_payble_amount' => 'required',
            'customs_code_id' => 'required',
            'code_number' => 'required',
            'uqc_id' => 'required',
            'unique_code' => 'required',
            'vendor_id' => 'required',
            'date_of_purchase' => 'required',
            'warranty_expiration' => 'required',

        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Validation failed! Please check the form and try again.');
        } else {

            if ($request->hasFile('insurance_file')) {
                $file = $request->file('insurance_file');
                $destinationPath = public_path('insurancefile');
                $fileName = $file->getClientOriginalName();
                $fileExtension = $file->getClientOriginalExtension();
                $newFileName = uniqid() . time() . '.' . $fileExtension;
                $file->move($destinationPath, $newFileName);
            }

            if ($request->hasFile('machine_assets_bill')) {
                $file = $request->file('machine_assets_bill');
                $destinationPath = public_path('machineassetsbill');
                $fileName = $file->getClientOriginalName();
                $fileExtension = $file->getClientOriginalExtension();
                $newFileName1 = uniqid() . time() . '.' . $fileExtension;
                $file->move($destinationPath, $newFileName1);
            }
            $machinaryassetslist = new Machinary_assets_list();
            $machinaryassetslist->owner_name = $request->owner_name;
            $machinaryassetslist->asset_category_id = $request->asset_category_id;
            $machinaryassetslist->machine_name = $request->machine_name;
            $machinaryassetslist->machine_qty = $request->machine_qty;
            $machinaryassetslist->machine_assets_bill = $newFileName1;
                      $machinaryassetslist->date_of_purchase = date('Y-m-d', strtotime($request->date_of_purchase));
            $machinaryassetslist->warranty_expiration = date('Y-m-d', strtotime($request->warranty_expiration));
            $machinaryassetslist->model_number = $request->model_number;
            $machinaryassetslist->achine_asset_price = $request->achine_asset_price;
            $machinaryassetslist->tax_rate = $request->tax_rate;
            $machinaryassetslist->total_payble_amount = $request->total_payble_amount;
            $machinaryassetslist->customs_code_id = $request->customs_code_id;
            $machinaryassetslist->code_number = $request->code_number;
            $machinaryassetslist->uqc_id = $request->uqc_id;
            $machinaryassetslist->unique_code = $request->unique_code;
            $machinaryassetslist->description = $request->description;
            $machinaryassetslist->vendor_id = $request->vendor_id;
            $machinaryassetslist->insurance_file = $newFileName;
            $machinaryassetslist->created_by = Auth::user()->id;
            $machinaryassetslist->save();
        }

        return redirect()->route('mine-machinary-assets-list-managment')->with('message', config('constant.add_machine_asset_list'));
    }

    public function edit($id)
    {

        $data = Machinary_assets_list::find($id);
        $assetCategorys = AssetCategroy::get();
        $vendors = Vendor_Managment::get();
        $qucs = Quc::get();
        return view('admin.machinary_and_assets_list.edit', compact('data', 'assetCategorys', 'vendors', 'qucs'));
    }

    public function update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'owner_name' => 'required',
            'asset_category_id' => 'required',
            'machine_name' => 'required',
            'machine_qty' => 'required',
            'model_number' => 'required',
            'achine_asset_price' => 'required',
            'tax_rate' => 'required',
            'total_payble_amount' => 'required',
            'customs_code_id' => 'required',
            'code_number' => 'required',
            'uqc_id' => 'required',
            'unique_code' => 'required',
            'vendor_id' => 'required',
              'date_of_purchase' => 'required',
            'warranty_expiration' => 'required',

        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Validation failed! Please check the form and try again.');
        } else {




            $machinaryassetslist = Machinary_assets_list::find($request->editid);
            $machinaryassetslist->owner_name = $request->owner_name;
            $machinaryassetslist->asset_category_id = $request->asset_category_id;
            $machinaryassetslist->machine_name = $request->machine_name;
            $machinaryassetslist->machine_qty = $request->machine_qty;
            if ($request->hasFile('machine_assets_bill')) {
                $file = $request->file('machine_assets_bill');
                $destinationPath = public_path('machineassetsbill');
                $fileName = $file->getClientOriginalName();
                $fileExtension = $file->getClientOriginalExtension();
                $newFileName1 = uniqid() . time() . '.' . $fileExtension;
                $file->move($destinationPath, $newFileName1);
                $machinaryassetslist->machine_assets_bill = $newFileName1;
            }

                       $machinaryassetslist->date_of_purchase = date('Y-m-d', strtotime($request->date_of_purchase));
            $machinaryassetslist->warranty_expiration = date('Y-m-d', strtotime($request->warranty_expiration));
            $machinaryassetslist->model_number = $request->model_number;
            $machinaryassetslist->achine_asset_price = $request->achine_asset_price;
            $machinaryassetslist->tax_rate = $request->tax_rate;
            $machinaryassetslist->total_payble_amount = $request->total_payble_amount;
            $machinaryassetslist->customs_code_id = $request->customs_code_id;
            $machinaryassetslist->code_number = $request->code_number;
            $machinaryassetslist->uqc_id = $request->uqc_id;
            $machinaryassetslist->unique_code = $request->unique_code;
            $machinaryassetslist->description = $request->description;
            $machinaryassetslist->vendor_id = $request->vendor_id;
            if ($request->hasFile('insurance_file')) {
                $file = $request->file('insurance_file');
                $destinationPath = public_path('insurancefile');
                $fileName = $file->getClientOriginalName();
                $fileExtension = $file->getClientOriginalExtension();
                $newFileName = uniqid() . time() . '.' . $fileExtension;
                $file->move($destinationPath, $newFileName);
                $machinaryassetslist->insurance_file = $newFileName;
            }

            $machinaryassetslist->updated_by = Auth::user()->id;
            $machinaryassetslist->save();
        }

        return redirect()->route('mine-machinary-assets-list-managment')->with('message', config('constant.update_machine_asset_list'));
    }

    public function delete($id)
    {

        $machinaryassetslist = Machinary_assets_list::find($id);
        $machinaryassetslist->deleted_by =  Auth::user()->id;
        $machinaryassetslist->deleted_at = now();
        if ($machinaryassetslist) {
            $machinaryassetslist->delete();
        }
        $machinaryassetslist->save();

        return redirect()->route('mine-machinary-assets-list-managment')->with('message', config('constant.delete_machine_asset_list'));
    }

    public function view(Request $request)
    {
        $id = $request->id;
        $data = Machinary_assets_list::with('vendore', 'uqc', 'category')->where('id', $id)->first();

        return response()->json(view('admin.machinary_and_assets_list.view', compact('data'))->render());
    }
}
