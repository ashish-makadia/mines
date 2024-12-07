<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\AssetCategroy;
use Spatie\Permission\Models\Permission;
use App\Http\Helpers\CommonFunction;
use Illuminate\Support\Facades\Auth ;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;


class AssetsCategroyController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $permission = Permission::where("name","assets_category")->first();
            $isPermission = CommonFunction::checkPermission($permission->id);
            if(!$isPermission){
                return redirect("/dashboard")->with("error","permission not allowed for this module");
            }
             return $next($request);
        });
    }

    public function index(Request $request)
    {
        if (\request()->ajax()) {
            $category = AssetCategroy::get();
            return DataTables::of($category)->addIndexColumn()->make(true);
        }
        return view('admin.assets_category.index');
    }

   

    public function addCategory(Request $request){

        $validator = Validator::make($request->all(), [
            'category_name' => 'required|unique:asset_categories', // Make sure this matches the actual field name in the database
        ], [
            'category_name.required' => 'Category is required.',
            'category_name.unique' => 'Please enter a unique Category.',
        ]);
       
       
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors())->with('error', 'Validation failed.');
        } else {
            $category = new AssetCategroy();
            $category->category_name = $request->category_name; // Use the correct field name here
            $category->created_at = now();
            $category->created_by = Auth::user()->id;
            $category->save();
        }
        return redirect()->route('assets-category')->with('message',config('constant.add_category'));

    }
    public function update(Request $request, $id)
    {
        
        $validator = Validator::make($request->all(), [
            'category_name' => 'required', // Make sure this matches the actual field name in the database
        ], [
            'category_name.required' => 'Category is required.',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors())->with('error', 'Validation failed.');
        }else{
            $category = AssetCategroy::find($id);
            $category->category_name = $request->input('category_name');
            $category->updated_at = now();
            $category->updated_by = Auth::user()->id;
            $category->save();
        }
        return redirect()->route('assets-category')->with('message',config('constant.update_category'));
    }
    public function delete($id)
    {
        $category =  AssetCategroy::find($id);
        if ( $category) {
            $category->delete();
        }
        return redirect()->route('assets-category')->with('message',config('constant.delete_category'));
    }
}
