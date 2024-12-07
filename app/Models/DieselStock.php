<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DieselStock extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function assetscategory()
    {
        return $this->belongsTo(AssetCategroy::class, 'diesel_stock_at')->withDefault();
    }
    public function vendor()
    {
        return $this->belongsTo(Vendor_Managment::class, 'vendor_id')->withDefault();
    }
}
