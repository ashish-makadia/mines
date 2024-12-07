<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Spatie\Permission\Models\Permission;
use App\Http\Helpers\CommonFunction;
use Illuminate\Support\Facades\Auth ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class UnitController extends Controller
{
     public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $permission = Permission::where("name","uom_list")->first();
            $isPermission = CommonFunction::checkPermission($permission->id);
            if(!$isPermission){
                return redirect("/dashboard")->with("error","permission not allowed for this module");
            }
             return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data=Unit::orderBy('id','DESC')->select('*');
            return DataTables::of($data)
            ->addIndexColumn()
        ->make(true);
        }
        return view('admin.unit.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validator= Validator::make($request->all(),
        [
            // 'designation'=> 'required',
            'unit' => 'required|unique:units',
        ]);
        if($validator->fails()){
            return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('error', 'Validation failed! Please check the form and try again.');
        }
        else{
        $inputs = $request->except('_token');

        if(Unit::create($inputs)) {
            return redirect()->back()->with('message',config('constant.add_unit'));
        }
        return redirect()->back()->with('error',config('constant.somthing_wrong'));
    }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $unit = Unit::where('id', $id)->first();
        // return response()->json(view('admin.sale_assets.edit', compact('assetCategorys','assets_type','vendors','assign_assets'))->render());
        return response()->json(["unit"=>$unit]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator= Validator::make($request->all(),
        [
            // 'designation'=> 'required',
            'unit' => 'required|unique:units',
        ]);
        if($validator->fails()){
            return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('error', 'Validation failed! Please check the form and try again.');
        }
        else{
            $inputs = $request->except('_token','_method');

        if(Unit::where("id",$id)->update($inputs)) {
            return redirect()->back()->with('message',config('constant.update_unit'));
        }
        return redirect()->back()->with('error',config('constant.somthing_wrong'));
    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(Unit::where("id",$id)->delete()) {
            // return response()->json()->with('message',config('constant.delete_sales_assets'));
            return response()->json(['message' => config('constant.delete_unit')]);
        }
        return response()->json(['error' => config('constant.somthing_wrong')]);
    }
}
