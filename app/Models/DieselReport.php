<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DieselReport extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table ="diesel_stock_report";
    public function vendor()
    {
        return $this->belongsTo(Vendor_Managment::class, 'vendor_id')->withDefault();
    }
}
