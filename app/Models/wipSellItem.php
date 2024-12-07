<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class wipSellItem extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table="wip_sell_item";
    public function wip_step3(){
        return $this->belongsTo(WorkInProgressStep3::class,'item_id');
    }
}
