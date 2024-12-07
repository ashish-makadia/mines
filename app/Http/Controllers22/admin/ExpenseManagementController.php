<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use Illuminate\Support\Facades\Auth;
use DataTables;

class ExpenseManagementController extends Controller
{
    public function  list(Request $request)
    {

        $expensecategorys = ExpenseCategory::get();
        if ($request->ajax()) {

            $expense = Expense::with('category')->orderBy('id', 'DESC')->select('*');

            return Datatables::of($expense)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {


                    return '<div class="d-flex action-btn-div">
                    <a class="btn btn-primary btn-sm" href="javascript:void(0);"  onclick="viewexpense(' . $row['id'] . ')" title="View">
                                                        <i class="fas fa-eye"></i></a> &nbsp
                    <a  href="javascript:void(0);" class="btn btn-info btn-sm"  onclick="editexpense(' . $row['id'] . ')"> <i class="fas fa-pencil-alt"></i></a>
                                                    
                    &nbsp
                    <a href="' . route('delete-expense', $row->id) . '" class="btn btn-danger btn-sm">
                    <i class="fas fa-trash"></i>
                    </a>
                 
                </div>';
                })

                ->addColumn('category_id', function ($row) {
                    if (!empty($row->category->exp_cat)) {
                        return $row->category->exp_cat;
                    } else {
                        return '';
                    }
                })



                ->addColumn('expense_date', function ($row) {
                    return date('d-m-Y', strtotime($row->expense_date));
                })

                ->addColumn('file', function ($row) {

                    $url = asset('public/attachment/' . $row->file);
                    return '<a href="' . $url . '" target="_blank">Click Here</a>';
                })


                ->rawColumns(['expense_date', 'category_id', 'file', 'action'])
                ->make(true);
        }
        return view('admin.expense.list', compact('expensecategorys'));
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'expense_date' => 'required',
            'category_id' => 'required',
            'amount' => 'required',
            'file' => 'required',

        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Validation failed! Please check the form and try again.');
        } else {
            $expense = new Expense();


            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $destinationPath = public_path('attachment');
                $fileName = $file->getClientOriginalName();
                $fileExtension = $file->getClientOriginalExtension();
                $newFileName = uniqid() . time() . '.' . $fileExtension;
                $file->move($destinationPath, $newFileName);
            }
            $expense->expense_date = date('Y-m-d', strtotime($request->expense_date));
            $expense->category_id = $request->category_id;
            $expense->amount = $request->amount;
            $expense->file = $newFileName;
            $expense->details = $request->details;
            $expense->created_by = Auth::user()->id;
            $expense->save();

            return redirect()->route('expense')->with('message', config('constant.add_expense'));
        }
    }


    public function edit(Request $request)
    {
        $id = $request->id;
        $data = Expense::where('id', $id)->first();
        $expensecategorys = ExpenseCategory::get();
        return response()->json(view('admin.expense.edit', compact('data', 'expensecategorys'))->render());
    }

    public function update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'expense_date' => 'required',
            'category_id' => 'required',
            'amount' => 'required',


        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Validation failed! Please check the form and try again.');
        } else {
            $expense =  Expense::find($request->editid);
            $expense->expense_date = date('Y-m-d', strtotime($request->expense_date));
            $expense->category_id = $request->category_id;
            $expense->amount = $request->amount;
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $destinationPath = public_path('attachment');
                $fileName = $file->getClientOriginalName();
                $fileExtension = $file->getClientOriginalExtension();
                $newFileName = uniqid() . time() . '.' . $fileExtension;
                $file->move($destinationPath, $newFileName);
                $expense->file = $newFileName;
            }

            $expense->details = $request->details;
            $expense->created_by = Auth::user()->id;
            $expense->save();

            return redirect()->route('expense')->with('message', config('constant.update_expense'));
        }
    }

    public function view(Request $request)
    {
        $id = $request->id;
        $data = Expense::with('category')->where('id', $id)->first();

        return response()->json(view('admin.expense.view', compact('data'))->render());
    }

    public function delete($id)
    {
        $expense =  Expense::find($id);
        $expense->deleted_by = Auth::user()->id;
        $expense->deleted_at = now();
        if ($expense) {
            $expense->delete();
        }
        $expense->save();
        return redirect()->route('expense')->with('message', config('constant.delete_expense'));
    }
}
