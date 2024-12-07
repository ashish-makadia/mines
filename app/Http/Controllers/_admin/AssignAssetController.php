<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Machinary_assets_list;
use App\Models\AssetCategroy;
use App\Models\Assign_Assets;
use App\Models\Mine;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use DataTables;

class AssignAssetController extends Controller
{
    public function index(Request $request){
        $mines= Mine::get();
        $assets=AssetCategroy::get();
        $machines=Machinary_assets_list::get();
        if($request->ajax()) {
            $assign_assets =Assign_Assets::with('mine','category')->orderBy('id', 'DESC')->select('*');
            return Datatables::of($assign_assets)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {


                return '<div class="d-flex action-btn-div">
                <a class="btn btn-primary btn-sm" href="javascript:void(0);"  onclick="viewdata(' . $row['id'] . ')" title="View">
                                                    <i class="fas fa-eye"></i></a> &nbsp
                <a  href="javascript:void(0);" onclick="editassignasset(' . $row['id'] . ')" class="btn btn-info btn-sm" > <i class="fas fa-pencil-alt"></i></a>
                                                  
                &nbsp
                <a href="'.route('delete-assign-asset', $row->id).'" class="btn btn-danger btn-sm">
                <i class="fas fa-trash"></i>
                </a>
             
            </div>';
            })
            ->addColumn('mine_id', function ($row) {
                if (!empty($row->mine->mine_name)) {
                    return $row->mine->mine_name;
                } else {
                    return '';
                }
            })
            ->addColumn('asset_category_id', function ($row) {
                if (!empty($row->category->category_name)) {
                    return $row->category->category_name;
                } else {
                    return '';
                }
            })
            ->addColumn('machine_id', function ($row) {
                $machine_id=explode(',',$row->machine_id);
                $machine_names = [];
                foreach($machine_id as $id){
                    $machine=Machinary_assets_list::where('id',$id)->pluck('machine_name')->first();
                    if ($machine) {
                        $machine_names[] = $machine;
                    }
                }
                return implode(', ', $machine_names);
            })
       
            ->rawColumns(['mine_id','asset_category_id','machine_id','action'])
                ->make(true);
        }
        return view('admin.assign_assets.index',compact('mines','assets','machines'));
    }


    public function store(Request $request)
    {
       // return explode(',',$request->machine_id);

        $validator=validator::make($request->all(),
        [
            'mine_id'=>'required',
            'asset_category_id'=>'required',
            'machine_id'=>'required|array',
        ]
   );
        if($validator->fails()){
            return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('error', 'Validation failed! Please check the form and try again.');
        }
        

        $existingAssignment = Assign_Assets::where('mine_id', $request->mine_id)
        ->where('asset_category_id', $request->asset_category_id)
        
        ->exists();

    if ($existingAssignment) {
        return redirect()->back();
           
    }

        else{
           
      
        
            $assign_assets=new Assign_Assets();
            $assign_assets->mine_id = $request->mine_id;
            $assign_assets->asset_category_id=$request->asset_category_id;
            $assign_assets->machine_id=implode(',',$request->machine_id);
            $assign_assets->created_by = Auth::user()->id;
           
           
            $assign_assets->save();
        }
        return redirect()->route('assign-asset')->with('message', config('constant.add_assign_assets'));
    }
    public function edit(Request $request)
    {
        $mines= Mine::get();
        $assets=AssetCategroy::get();
        $machines=Machinary_assets_list::get();
        $id = $request->id;
        $assign_assets = Assign_Assets::where('id', $id)->first();

        return response()->json(view('admin.assign_assets.edit', compact('assign_assets','mines','assets','machines'))->render());
    }  

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mine_id'=>'required',
            'asset_category_id'=>'required',
            'machine_id'=>'required',
        ]);
        if($validator->fails()){
            return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('error', 'Validation failed! Please check the form and try again.');
        }
        else{
            $assign_assets = Assign_Assets::find($request->editid);
            $assign_assets->mine_id = $request->mine_id;
            $assign_assets->asset_category_id=$request->asset_category_id;
            $assign_assets->machine_id=implode(',',$request->machine_id);
            $assign_assets->updated_by = Auth::user()->id;
            $assign_assets->save();
            return redirect()->back()->with('message', config('constant.update_assign_assets')); 
        }
    }

    public function view(Request $request)
    {
        $id = $request->id;
        $data = Assign_Assets::with('mine','category')->where('id', $id)->first();
        $machine_id=explode(',',$data->machine_id);
                $machine_names = [];
                foreach($machine_id as $id){
                    $machine=Machinary_assets_list::where('id',$id)->pluck('machine_name')->first();
                    if ($machine) {
                        $machine_names[] = $machine;
                    }
                }
                $machine_names_str =   implode(', ', $machine_names);


    return response()->json(view('admin.assign_assets.view', compact('data','machine_names_str'))->render());
    
    }

    public function delete($id)  
    {

        $assign_assets = Assign_Assets::find($id)->first();
        $assign_assets->deleted_by = Auth::user()->id;
        $assign_assets->deleted_at = now();
        if ( $assign_assets) {
            $assign_assets->delete();
        }
        $assign_assets->save();
        return redirect()->back()->with('message', config('constant.delete_assign_assets'));
    }
}
