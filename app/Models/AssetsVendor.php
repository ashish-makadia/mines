<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetsVendor extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table ="assets_vendor";
    public function vendor()
    {
        return $this->belongsTo(Vendor_Managment::class, 'vendor_id')->withDefault();
    }
}
