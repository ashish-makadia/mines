<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{City, State, Customer_Managment, CreditDay};
use Illuminate\Support\Facades\Validator;
use DataTables;
use Illuminate\Support\Facades\Auth;

class CustomerManagmentController extends Controller
{
    public function index()
    {
        
        $data['states'] = State::get();
        $days = CreditDay::get();
        if (\request()->ajax()) {
            $customer = Customer_Managment::with('state', 'city')->orderBy('id', 'DESC')->get();
            return DataTables::of($customer)->addIndexColumn()
                ->addColumn('city_name', function (Customer_Managment $customer) {
                    return $customer->city ? $customer->city->name : '';
                })
                ->addColumn('state_name', function (Customer_Managment $customer) {
                    return $customer->state ? $customer->state->name : '';
                })
                ->make(true);
        }
        return view('admin.customer_managment.index', $data, compact('days'));
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_name'   => 'required',
            'customer_number' => ['required', 'regex:/^\d{10}$/'],
            'customer_email'  => 'required|email|unique:customer__managments,customer_email',

            'customer_gst' => [
                'required',
                'regex:/^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$/',
                'unique:customer__managments,customer_gst'
            ],
            'customer_pan' => [
                'required',
                'regex:/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/',
                'unique:customer__managments,customer_pan'
            ],
            'state_id'  => 'required',
            'city_id'   =>  'required',
            'customer_addr'   => 'required',
            'customer_pin'    => ['required', 'regex:/^[0-9]{6}$/'],
            'credit_days'   => 'required',
        ]);
        if ($validator->fails()) {
            return  redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Validation failed! Please check the form and try again.');
        } else {

            $customer = new Customer_Managment();
            $customer->customer_name = $request->input('customer_name');
            $customer->customer_number = $request->input('customer_number');
            $customer->customer_email = $request->input('customer_email');
            $customer->customer_gst = $request->input('customer_gst');
            $customer->customer_pan = $request->input('customer_pan');
            $customer->state_id = $request->input('state_id');
            $customer->city_id = $request->input('city_id');
            $customer->customer_addr = $request->input('customer_addr');
            $customer->customer_pin = $request->input('customer_pin');
            $customer->credit_days = $request->input('credit_days');
            $customer->created_by = Auth::user()->id;
            $customer->save();
        }


        return redirect()->route('customer-managment')->with('message', config('constant.add_customer'));
    }




    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'customer_name'   => 'required',
            'customer_number' => ['required', 'regex:/^\d{10}$/'],
            'customer_email'  => 'required|email',
            'customer_gst' => [
                'required',
                'regex:/^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$/'

            ],
            'customer_pan' => [
                'required',
                'regex:/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/'

            ],
            'state_id'  => 'required',
            'city_id'   =>  'required',
            'customer_addr'   => 'required',
            'customer_pin'    => ['required', 'regex:/^[0-9]{6}$/'],
            'credit_days'   => 'required',
        ]);


        if ($validator->fails()) {
            return  redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Validation failed! Please check the form and try again.');
        } else {

            $customer = Customer_Managment::find($id);
            $customer->customer_name = $request->input('customer_name');
            $customer->customer_number = $request->input('customer_number');
            $customer->customer_email = $request->input('customer_email');
            $customer->customer_gst = $request->input('customer_gst');
            $customer->customer_pan = $request->input('customer_pan');
            $customer->state_id = $request->input('state_id');
            $customer->city_id = $request->input('city_id');
            $customer->customer_addr = $request->input('customer_addr');
            $customer->customer_pin = $request->input('customer_pin');
            $customer->credit_days = $request->input('credit_days');
            $customer->updated_by =  Auth::user()->id;
            $customer->updated_at =  now();
            $customer->save();
        }
        return redirect()->route('customer-managment')->with('message', config('constant.update_customer'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $customer =  Customer_Managment::find($id);
        $customer->delete_by = Auth::user()->id;
        $customer->deleted_at = now();
        if ($customer) {
            $customer->delete();
        }
        $customer->save();
        return redirect()->route('customer-managment')->with('message', config('constant.delete_customer'));
    }
}
