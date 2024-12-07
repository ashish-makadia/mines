<?php
namespace App\Http\Helpers;
use App\Models\wipSellItem;
use App\Models\Role;
use Illuminate\Support\Facades\Auth ;
class CommonFunction {
    public static function getWipNo($id){
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
     public static function getRemQty($id,$totalQty){
        $sellQty = wipSellItem::where("item_id",$id)->sum("sellQty");
        return $totalQty-$sellQty;
    }
    public static function checkPermission($perId){
        $user = Auth::user();

        $role = Role::find($user->role_id);
        $perArr = json_decode($role->permissions,true);

        if(in_array($perId,$perArr)){
            return true;
        }
        return false;
    }
}
    ?>
