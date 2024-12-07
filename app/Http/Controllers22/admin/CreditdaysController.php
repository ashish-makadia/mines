<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\CreditDay;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Auth;

class CreditdaysController extends Controller   
{
    public function index(){
        if (\request()->ajax()) {
            $credit = CreditDay::orderBy('id', 'DESC')->get();
            return DataTables::of($credit)->addIndexColumn()->make(true);
        }
        return view('admin.credit_days.index');
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'days' => 'required|unique:credit_days',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors())->with('error', 'Validation failed.');
        } else {

            $credit = new CreditDay();
            $credit->days = $request->days;
            $credit->created_at = now();
            $credit->created_by = Auth::user()->id;
            $credit->save();
        }
        return redirect()->route('credit-days')->with('message',config('constant.add_credit_day'));
    }
    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'days' => 'required|unique:credit_days',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors())->with('error', 'Validation failed.');
        } else {
            $credit = CreditDay::find($id);   
            $credit->days = $request->input('days');
            $credit->updated_at = now();
            $credit->updated_by = Auth::user()->id;
            $credit->save();   
        }
        return redirect()->route('credit-days')->with('message',config('constant.update_credit_day'));
    }

    public function delete($id)
    {
        $credit =  CreditDay::find($id);
        if ( $credit) {
            $credit->delete();
        } 
        return redirect()->route('credit-days')->with('message',config('constant.delete_credit_day'));    
    }
}
