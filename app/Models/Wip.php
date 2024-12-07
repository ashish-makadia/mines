<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wip extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table="workinprogress";

    public function wip_step(){
        return $this->hasMany(WorkingProgressStep2::class);
    }
    public function wip_step3(){
        return $this->hasMany(WorkInProgressStep3::class);
    }
    public function waste_volume(){
        return $this->belongsTo(Quc::class,'waste_quc_id');
    }
    public function incharge(){
        return $this->belongsTo(Employee::class,'incharge_id');
    }
    public function luffers_volume(){
        return $this->belongsTo(Quc::class,'luffers_quc_id');
    }
}
