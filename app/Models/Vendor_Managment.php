<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Vendor_Managment extends Model
{
    use HasFactory, SoftDeletes;
     protected $table="vendor_managments";
     protected $fillable =[
        "vendor_name", "vendor_number","vendor_email","vendor_gst","vendor_pan",
        "state_id","city_id","vendor_addr","vendor_pin","credit_days",
     ];
     public function state()
     {
         return $this->belongsTo(State::class, 'state_id');
     }
 
     public function city()
     {
         return $this->belongsTo(City::class, 'city_id');
     }
    

}
