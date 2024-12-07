<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkInProgressStep3 extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = "workinprogress_step3_detail";
     public function wip_stock(){
        return $this->hasMany(WipStock::class,"item_id");
    }
}
