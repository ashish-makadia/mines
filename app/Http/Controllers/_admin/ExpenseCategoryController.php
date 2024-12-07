<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\ExpenseCategory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Auth;

class ExpenseCategoryController extends Controller
{
    
    public function index(Request $request)
    {
        if (\request()->ajax()) {
            $exp_cat = ExpenseCategory::orderBy('id', 'DESC')->get();
            return DataTables::of($exp_cat)->addIndexColumn()->make(true);
        }
        return view('admin.expense_category.index');
    }

   

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'exp_cat'=>'required|unique:expense_categories',
        ]);
       
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors())->with('error', 'Validation failed.');
        } else {
            $exp_cat = new ExpenseCategory();
            $exp_cat->exp_cat = $request->exp_cat;
            $exp_cat->created_at = now();
            $exp_cat->created_by = Auth::user()->id;
            $exp_cat->save();
        }
        return redirect()->route('expense-category')->with('message',config('constant.add_category'));

    }

    public function update(Request $request)
    {
     
    //    return  $request->id;
        $validator = Validator::make($request->all(), [
            'exp_cat'=>'required',
        ]);
       
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors())->with('error', 'Validation failed.');
        } else {
            $exp_cat = ExpenseCategory::find($request->id);
        
            $exp_cat->exp_cat = $request->exp_cat;
            $exp_cat->updated_at = now();
            $exp_cat->updated_by = Auth::user()->id;
            $exp_cat->save();
        }
        return redirect()->route('expense-category')->with('message',config('constant.update_category'));
    }

    public function delete($id)
    {
        $exp_cat =  ExpenseCategory::find($id);
        $exp_cat->deleted_by =  Auth::user()->id;
        $exp_cat->deleted_at =  now();
         if ( $exp_cat) {
            $exp_cat->delete();
         }
         $exp_cat->save();
         return redirect()->route('expense-category')->with('message',config('constant.delete_category'));
    }

}
