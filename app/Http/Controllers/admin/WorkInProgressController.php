<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Wip;
use App\Models\Mine;
use App\Models\Employee;
use App\Models\Quc;
use App\Models\wipSellItem;
use Spatie\Permission\Models\Permission;
use App\Http\Helpers\CommonFunction;
use Illuminate\Support\Facades\Auth ;
use App\Models\WipStock;
use App\Models\WorkingProgressStep2;
use App\Models\WorkInProgressStep3;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class WorkInProgressController extends Controller
{
     public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $permission = Permission::where("name","wip_list")->first();
            $isPermission = CommonFunction::checkPermission($permission->id);
            if(!$isPermission){
                return redirect("/dashboard")->with("error","permission not allowed for this module");
            }
             return $next($request);
        });
    }
    public function index(Request $request)
    {
        if($request->ajax()) {
            $mineId = Session::get("mine_id");
            $wip = Wip::with('incharge')->where("mine_id",$mineId)->get();
            $wip->map(function ($item) {
                $stockItems = WorkInProgressStep3::where("wip_id", $item->id)
                ->sum("no_of_pieces");
                $item->total_pieces = $stockItems;
                return $item;
            });
            return DataTables::of($wip)->addIndexColumn()->make(true);
        }
        return view('admin.wip.list');
    }

    /**
     * Show the step One Form for creating a new .
     *
     * @return \Illuminate\Http\Response
     */
    public function getWipNo($id){
        $id = $id>0?$id:0;
        $no = $id+1;
        if($id >= 1 && $id < 10){
            $no = "0000".$no;
        }
        else if($id >= 10 && $id < 100){
            $no = "000".$no;
        }
        else if($id >= 100 && $id < 1000){
            $no = "00".$no;
        }
        else if($id >= 1000 ){
            $no = "0".$no;
        }
        return $no;
    }

    public function createStepOne(Request $request)
    {
        $quc = Quc::get();
        $emp = Employee::get();
        $userId = Auth::user()->id;
        $mineId = Session::get("mine_id");
        $mine = Mine::find($mineId);
        $wipData = Wip::orderBy("id", "desc")->first();
        $lastId = $wipData->id??1;
        $wipNo = $this->getWipNo($lastId);

        if($mine){
            $wipNo = strtoupper(substr($mine->mine_name, 0, 4))."".$wipNo;
        }
// dd($mineId);
        $wip = Wip::with("wip_step","wip_step3")->where(["user_id" => $userId,"mine_id" => $mineId])->where("status","!=","completed")->orderBy("id","desc");
        // dd($wip->toSql());
        // dd($wip->getBindings());
        $wip = $wip->first();
// dd($wip);
        $data = Session::get('work_in_progress', []);
        return view('admin.wip.index',compact('quc','emp','data','wip','wipNo'));

    }

    public function edit(Request $request,$id)
    {
        $quc = Quc::get();
        $emp = Employee::get();
        $userId = Auth::user()->id;
        $mineId = Session::get("mine_id");
        $mine = Mine::find($mineId);
        $wipData = Wip::orderBy("id", "desc")->first();
        $lastId = $wipData->id??1;
        $wipNo = $this->getWipNo($lastId);
        if($mine){
            $wipNo = strtoupper(substr($mine->mine_name, 0, 4))."".$wipNo;
        }
        $isEdit = true;
        $wip = Wip::with("wip_step","wip_step3")->find($id);
        $wip->current_step = 1;
        $data = Session::get('work_in_progress', []);
        return view('admin.wip.index',compact('quc','emp','data','wip','wipNo','isEdit'));
    }

    /**
     * Post Request to store step1 info in session
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postCreateStepOne(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'wp_no' => 'required',
            'target' => 'required',
            'quc_id' => 'required',
            'no_of_days' => 'required|numeric',
            'incharge_id' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(["errors"=>$validator->errors()],400);
            // return redirect()->back()->withErrors($validator)->withInput();
        }

        $inputs = $request->except('_token','wipId');
        $inputs["user_id"] = Auth::user()->id;
        $inputs["mine_id"] = Session::get("mine_id");
        $inputs["start_date"] = date("Y-m-d",strtotime($request->start_date));
        $inputs["status"] = "pending";
        $inputs["current_step"] = 2;

        // return response()->json(['status' => true]);

        if($request->wipId > 0){
            $wipId = Wip::where("id",$request->wipId)->update($inputs);
            $wipId = $request->wipId;
        } else {
            $wip = Wip::create($inputs);
            $wipId = isset($wip->id)?$wip->id:"";
        }
        if($wipId){
            return response()->json(['status' => true,'id'=>$wipId]);
        }
            //    return redirect()->route('wip.create.step.two');
    }

    /**
     * Show the step One Form for creating a new product.
     *
     * @return \Illuminate\Http\Response
     */
    public function createStepTwo(Request $request)
    {
        $quc = Quc::get();
        $emp = Employee::get();
        $data = Session::get('work_in_progress', []);
        $wipId = Session::get('wipId');
        $wip = Wip::find($wipId);

        return view('admin.wip._step2_form',compact('quc','emp','wip'));
    }

    /**
     * Show the step One Form for creating a new product.
     *
     * @return \Illuminate\Http\Response
     */
    public function postCreateStepTwo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'no_of_pieces' => 'required',
            // 'current_date' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(["errors"=>$validator->errors()],400);
            // return redirect()->back()->withErrors($validator)->withInput();
        }
        $inputs = $request->except('_token',"step2_id","size_of_pic","pic_image",'wipId','fileName');
        $inputs["user_id"] = Auth::user()->id;
        // $inputs["current_date"] = date("Y-m-d",strtotime($request->current_date));
        $inputs["current_date"] = date("Y-m-d");
        $inputs["current_step"] = 3;

        $wipId = $request->wipId;
        $wip = Wip::where("id",$wipId)->update($inputs);

        if($wip){
            $detail = [];
                WorkingProgressStep2::where("wip_id",$request->wipId)->delete();
                foreach ($request->size_of_pic as $key => $value) {
                    $detail["wip_id"] = $request->wipId;
                    $detail["size_of_piece"] = $value;
                    if($request->hasFile('pic_image') && isset($request->pic_image[$key])){
                        $file = $request->pic_image[$key];
                        // $inputs["data"][$key] = $value;
                        $filename = time().'_'.$file->getClientOriginalName();
                        // Store the file and get the path
                        // $path = $file->storeAs('uploads', $filename, 'public');
                        $destinationPath = public_path('/uploads');
                        $file->move($destinationPath,$filename);
                        $detail['upload_pic'] = $filename;
                    } else {
                        $detail['upload_pic'] =  $request->fileName[$key]??"";
                    }
                    WorkingProgressStep2::create($detail);
                }
            // return redirect()->route('wip.create.step.two');
            return response()->json(['status' => true,'id'=>$wipId,"no_of_pieces"=>$request->no_of_pieces]);
        }
        return response()->json(['status' => false,'id'=>$wipId]);
    }

    /**
     * Show the step One Form for creating a new product.
     *
     * @return \Illuminate\Http\Response
     */
    public function createStepThree(Request $request)
    {
        $quc = Quc::get();
        $emp = Employee::get();
        $wipId = Session::get('wipId');
        $wip = Wip::find($wipId);
        return view('admin.wip._step3_form',compact('emp','quc','wip','data'));
    }

    public function getStepData(Request $request)
    {
        $wip = (object)[];;
        if($request->id)
            $wip = Wip::find($request->id);
         $quc = Quc::get();
          $emp = Employee::get();
        if($request->step == 1){
             return response()->json(view('admin.wip._step1_form', compact('wip','quc','emp'))->render());
        }
        else if($request->step == 2){
            return response()->json(view('admin.wip._step2_form', compact('wip','quc','emp'))->render());
        }
        else if($request->step == 3){
            return response()->json(view('admin.wip._step3_form', compact('wip','quc','emp'))->render());
        }
    }

    /**
     * Show the step One Form for creating a new product.
     *
     * @return \Illuminate\Http\Response
     */
    public function postCreateStepThree(Request $request)
    {
        $wipId = Session::get('wipId');

        if($request->btnValue === "finish_wp"){
            $request->session()->forget('wipId');
            $inputs['status'] = "completed";
        } else {
             $inputs["user_id"] = Auth::user()->id;
        $inputs["finish_good"] = $request->finish_good;
        $inputs["finished_current_date"] = date("Y-m-d");
        // $inputs["finished_current_date"] = date("Y-m-d",strtotime($request->finished_current_date));
        $inputs["waste_quantity"] = $request->waste_quantity;
        $inputs["waste_quc_id"] = $request->waste_quc_id;
        $inputs["luffers_quantity"] = $request->luffers_quantity;
        $inputs["luffers_quc_id"] = $request->luffers_quc_id;
        $inputs["current_step"] = 3;
        if($request->hasFile("waste_uploaded_pic")){
            $file = $request->waste_uploaded_pic;
            $filename = time().'_'.$file->getClientOriginalName();
            $destinationPath = public_path('/uploads/step3');
            $file->move($destinationPath,$filename);
            $inputs['waste_uploaded_pic'] = $filename;
        }
        if($request->hasFile("luffers_uploaded_pic")){
            $file = $request->luffers_uploaded_pic;
            $filename = time().'_'.$file->getClientOriginalName();
            $destinationPath = public_path('/uploads/step3');
            $file->move($destinationPath,$filename);
            $inputs['luffers_uploaded_pic'] = $filename;
        }
         $wip = Wip::find($request->wipId);
            $inputs["waste_quantity"] = ($wip->waste_quantity??0)+$request->waste_quantity;
            $inputs["luffers_quantity"] = ($wip->waste_quantity??0)+$request->luffers_quantity;
            $inputs['status'] = $wip->status != "completed"?"updated":"completed";
        }
        $wip = [];

        if($request->wipId > 0){
            Log::info(json_encode($inputs));
            $wip = Wip::where("id",$request->wipId)->update($inputs);
        }

        if($wip){
            $detail = [];
            if($request->isEdit){
                WorkInProgressStep3::where("wip_id",$request->wipId)->delete();
            }
            // WorkInProgressStep3::where("wip_id",$request->wipId)->delete();
            foreach ($request->height as $key => $value) {
                $detail["wip_id"] = $request->wipId;
                $detail["current_date"] = date("Y-m-d",strtotime($request->finished_current_date));
                $detail["height"] = $request->height[$key];
                $detail["weight"] = $request->weight[$key];
                $detail["width"] = $request->width[$key];
                $detail["gunfoot"] = $request->gunfoot[$key];
                $detail["no_of_pieces"] = $request->no_of_pieces[$key];

                if($request->hasFile("uploaded_pic") && isset($request->uploaded_pic[$key])){
                    $file = $request->uploaded_pic[$key];
                    // $inputs["data"][$key] = $value;
                    $filename = time().'_'.$file->getClientOriginalName();
                    // Store the file and get the path
                    // $path = $file->storeAs('uploads', $filename, 'public')
                    $destinationPath = public_path('/uploads/step3/'.$request->wipId.'/');
                    $file->move($destinationPath,$filename);
                    $detail['uploaded_pic'] = $filename;
                }else {
                    $detail['uploaded_pic'] =  $request->fileName[$key]??"";
                }
                $wipItem =  WorkInProgressStep3::create($detail);
            }
            if($request->btnValue === "finish_wp"){
                $request->session()->forget('wipId');
            }
        }
        return response()->json(['status' => true,'id'=>$request->wipId]);
        // return redirect()->route('wip.index')
    }

    public function update(Request $request, string $id)
    {
        $inputs = $request->except('_token','_method');
        if($disaptch = Wip::where("id",$id)->update($inputs)) {
            return redirect()->back()->with('message',config('constant.update_sell_register'));
        }
        return redirect()->back()->with('error',config('constant.somthing_wrong'));
    }

    public function updateStockOfFinishedGood(Request $request,$id){
        $wip = Wip::with('wip_step3','waste_volume','luffers_volume')->find($id);

        return view('admin.wip.stockofFinishedgood',compact("wip"));
    }
}
