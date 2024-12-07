<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AssetCategroy;
use App\Models\WireSaw;
use App\Models\Mine;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Http\Helpers\CommonFunction;
use Illuminate\Support\Facades\Auth ;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Quc;

class WireSawController extends Controller
{
     public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $permission = Permission::where("name","wiresaw_register")->first();
            $isPermission = CommonFunction::checkPermission($permission->id);
            if(!$isPermission){
                return redirect("/dashboard")->with("error","permission not allowed for this module");
            }
             return $next($request);
        });
    }
    public function index(Request $request)
    {
        $quc=Quc::get();
        if($request->ajax()){
            $data=WireSaw::with('quc')->orderBy('id','DESC')->select('*');
            
            return DataTables::of($data)
            ->addIndexColumn()
            
            ->addColumn('quc_id', function ($row) {
                
                if (!empty($row->quc->uqc_code)) {
                    return $row->quc->uqc_code;
                } else {
                    return '';

                }
            })
            ->rawColumns(['quc_id'])
        ->make(true);
        }
        return view('admin.wiresaw.index',compact('quc'));
        
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
        $quc=Quc::get();
        $wire_saw = WireSaw::find($id);
      
        return response()->json(['wire_saw' => $wire_saw,'quc' => $quc]);
    }

    public function update(Request $request, string $id)
    {
        $inputs = $request->except('_token','_method');
        // $inputs = $request->quc_id;
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
