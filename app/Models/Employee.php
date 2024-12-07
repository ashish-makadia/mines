<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table="employee";
    
    protected $guarded = [];
     public function department()
    {
        return $this->belongsTo(Department::class, 'depart_id')->withDefault();
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class, 'designation_id')->withDefault();
    }
}
