<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer_Managment extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table="customer_managments";
     protected $fillable =[
        "customer_name", "customer_number","customer_email","customer_gst","customer_pan",
        "state_id","city_id","customer_addr","customer_pin","credit_days",
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
