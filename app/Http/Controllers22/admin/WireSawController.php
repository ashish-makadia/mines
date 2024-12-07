<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AssetCategroy;
use App\Models\WireSaw;
use App\Models\Mine;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class WireSawController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            $data =WireSaw::orderBy('id', 'DESC')->select('*');
            return DataTables::of($data) ->addIndexColumn()->make(true);
        }
        return view('admin.wiresaw.index');
    }

    public function store(Request $request)
    {
        $inputs = $request->except('_token');
        $inputs["date"] = date("Y-m-d",strtotime($request->date));

        if(WireSaw::create($inputs)){
            return redirect()->back()->with('message',config('constant.add_wiresaw'));
        }
        return redirect()->back()->with('error',config('constant.somthing_wrong'));
    }

    public function edit(string $id)
    {
        $wire_saw = WireSaw::find($id);
        return response()->json(['wire_saw' => $wire_saw]);
    }

    public function update(Request $request, string $id)
    {
        $inputs = $request->except('_token','_method');
        $inputs["date"] = date("Y-m-d",strtotime($request->date));
        if(WireSaw::where("id",$id)->update($inputs)) {
            return redirect()->back()->with('message',config('constant.update_wiresaw'));
        }
        return redirect()->back()->with('error',config('constant.somthing_wrong'));
    }

    public function destroy(string $id)
    {
        if(WireSaw::where("id",$id)->delete()) {
            // return response()->json()->with('message',config('constant.delete_sales_assets'));
            return response()->json(['message' => config('constant.delete_wiresaw')]);
        }
        return response()->json(['error' => config('constant.somthing_wrong')]);
    }

}
