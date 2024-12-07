<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\Mine;
use App\Models\product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Auth;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $mines= Mine::get();
        if($request->ajax()){
            $product=product::with('mine')->orderBy('id', 'DESC')->select('*');
            return DataTables::of($product)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {


                return '<div class="d-flex action-btn-div">
                <a class="btn btn-primary btn-sm" href="javascript:void(0);"  onclick="viewdata(' . $row['id'] . ')" title="View">
                                                    <i class="fas fa-eye"></i></a> &nbsp
                <a  href="javascript:void(0);" class="btn btn-info btn-sm" onclick="editproduct(' . $row['id'] . ')" > <i class="fas fa-pencil-alt"></i></a>
                                                
                &nbsp
                <a href="' . route('delete-product', $row->id) . '" class="btn btn-danger btn-sm">
                    <i class="fas fa-trash"></i>
                    </a>
             
            </div>';
            })
            ->addColumn('mines_id',function($row){
                if(!empty($row->mine->mine_name))
                {return $row->mine->mine_name;}
                else{
                    return '';
                }
            })
            ->rawColumns(['mine_id', 'action'])
            ->make(true);
            
        }
      return view('admin.product.index',compact('mines'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product' => 'required',
            'mines_id' => 'required',
            'weight' => 'required',
            'rate' => 'required',
            'amount' => 'required',

        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Validation failed! Please check the form and try again.');
        } else {

            $product = new  product();
            $product->product = $request->product;
            $product->mines_id = $request->mines_id;
            $product->weight = $request->weight;
            $product->rate = $request->rate;
            $product->amount = $request->amount;
            $product->created_by = Auth::user()->id;
            $product->save();

            return redirect()->back()->with('message', config('constant.add_product'));
        }
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $product = product::where('id', $id)->first();
        $mines= Mine::get();
        return response()->json(view('admin.product.edit', compact('product','mines'))->render());
    }


       public function  update (Request $request) {
        $validator = Validator::make($request->all(), [
            'product' => 'required',
            'mines_id' => 'required',
            'weight' => 'required',
            'rate' => 'required',
            'amount' => 'required',

        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Validation failed! Please check the form and try again.');
        } else {

            $product = product::find($request->editid);
            $product->product = $request->product;
            $product->mines_id = $request->mines_id;
            $product->weight = $request->weight;
            $product->rate = $request->rate;
            $product->amount = $request->amount;
            $product->created_by = Auth::user()->id;
            $product->save();

            return redirect()->back()->with('message', config('constant.update_product'));
        }
       }

       public function viewproduct(Request $request)
       {
           $id = $request->id;
           $product = product::with('mine')->where('id', $id)->first();
          
           return response()->json(view('admin.product.view', compact('product'))->render());
       }
       
       public function delete($id)
       {
   
           $product = product::find($id);
           $product->deleted_by = Auth::user()->id;
           $product->deleted_at = now();
           if ($product) {
               $product->delete();
           }
           $product->save();
           return redirect()->back()->with('message', config('constant.delete_product'));
       }
}
