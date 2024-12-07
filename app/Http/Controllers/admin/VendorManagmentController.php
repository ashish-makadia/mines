<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Http\Helpers\CommonFunction;
use Illuminate\Support\Facades\Auth ;
use App\Models\{Vendor_Managment, CreditDay, State, City};
use Illuminate\Support\Facades\Validator;
use DataTables;

class VendorManagmentController extends Controller
{
     public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $permission = Permission::where("name","vendor_management")->first();
            $isPermission = CommonFunction::checkPermission($permission->id);
            if(!$isPermission){
                return redirect("/dashboard")->with("error","permission not allowed for this module");
            }
             return $next($request);
        });
    }
    public function index()
    {
        $data['states'] = State::get();
        $days = CreditDay::get();
        if (\request()->ajax()) {
            $vendor = Vendor_Managment::orderBy('id', 'DESC')->get();
            return DataTables::of($vendor)->addIndexColumn()
                ->addColumn('city_name', function (Vendor_Managment $vendor) {
                    return $vendor->city ? $vendor->city->name : '';
                })
                ->addColumn('state_name', function (Vendor_Managment $vendor) {
                    return $vendor->state ? $vendor->state->name : '';
                })->make(true);
        }
        return view('admin.vendor_managment.index', $data, compact('days'));
    }

    public function getcity(Request $request)
    {
        $data['cities'] = City::where("state_id", $request->state_id)->get(["name", "id"]);
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'vendor_name'   => 'required',
            'vendor_number' => ['required', 'regex:/^\d{10}$/'],
            'vendor_email'  => 'required|email|unique:vendor_managments,vendor_email',
            'vendor_gst' => [
                'required',
                'regex:/^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$/',
                'unique:vendor_managments,vendor_gst'
            ],
            'vendor_pan' => [
                'required',
                'regex:/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/',
                'unique:vendor_managments,vendor_pan'
            ],
            'state_id'  => 'required',
            'city_id'   =>  'required',
            'vendor_addr'   => 'required',
            'vendor_pin'    => ['required', 'regex:/^[0-9]{6}$/'],
            'credit_days'   => 'required',
        ]);
        if ($validator->fails()) {
            return  redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Validation failed! Please check the form and try again.');
        } else {

            //   $input=$request->except("_token");
            //   $vendor = Vendor_Managment::create($input);
            $vendor =  new Vendor_Managment();
            $vendor->vendor_name = $request->input('vendor_name');
            $vendor->vendor_number = $request->input('vendor_number');
            $vendor->vendor_email = $request->input('vendor_email');
            $vendor->vendor_gst = $request->input('vendor_gst');
            $vendor->vendor_pan = $request->input('vendor_pan');
            $vendor->state_id = $request->input('state_id');
            $vendor->city_id = $request->input('city_id');
            $vendor->vendor_addr = $request->input('vendor_addr');
            $vendor->vendor_pin = $request->input('vendor_pin');
            $vendor->credit_days = $request->input('credit_days');
            $vendor->created_by = Auth::user()->id;
            $vendor->save();
            //   if($vendor){

            //   }
        }

        return redirect()->route('vendor-managment')->with('message', config('constant.add_vendore'));
    }




    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'vendor_name'   => 'required',
            'vendor_number' => ['required', 'regex:/^\d{10}$/'],
            'vendor_email'  => 'required',
            'vendor_gst' => [
                'required',
                'regex:/^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$/'

            ],
            'vendor_pan' => [
                'required',
                'regex:/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/'
            ],
            'state_id'  => 'required',
            'city_id'   =>  'required',
            'vendor_addr'   => 'required',
            'vendor_pin'    => ['required', 'regex:/^[0-9]{6}$/'],
            'credit_days'   => 'required',
        ]);
        // $vendor = Vendor_Managment::find($id);

        // if (!$vendor) {

        //     return  redirect()->back()

        //         ->withInput()
        //         ->with('error', 'Validation failed! Please check the form and try again.');
        // }

        if ($validator->fails()) {
            return  redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Validation failed! Please check the form and try again.');
        } else {
            $vendor = Vendor_Managment::find($id);
            $vendor->vendor_name = $request->input('vendor_name');
            $vendor->vendor_number = $request->input('vendor_number');
            $vendor->vendor_email = $request->input('vendor_email');
            $vendor->vendor_gst = $request->input('vendor_gst');
            $vendor->vendor_pan = $request->input('vendor_pan');
            $vendor->state_id = $request->input('state_id');
            $vendor->city_id = $request->input('city_id');
            $vendor->vendor_addr = $request->input('vendor_addr');
            $vendor->vendor_pin = $request->input('vendor_pin');
            $vendor->credit_days = $request->input('credit_days');
            $vendor->updated_by = Auth::user()->id;
            $vendor->save();
        }
        return redirect()->route('vendor-managment')->with('message', config('constant.update_vendore'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $vendor =  Vendor_Managment::find($id);
        $vendor->deleted_by  = Auth::user()->id;
        $vendor->deleted_at =  now();
        if ($vendor) {
            $vendor->delete();
        }
        $vendor->save();

        return redirect()->route('vendor-managment')->with('message', config('constant.delete_vendore'));
    }
}
