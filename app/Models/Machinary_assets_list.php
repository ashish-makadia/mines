<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Machinary_assets_list extends Model
{
    use HasFactory, SoftDeletes;

    public function vendore()
    {
        return $this->belongsTo(Vendor_Managment::class, 'vendor_id')->withDefault();
    }

    public function uqc()
    {
        return $this->belongsTo(Quc::class, 'uqc_id')->withDefault();
    }

    public function category()
    {
        return $this->belongsTo(AssetCategroy::class, 'asset_category_id')->withDefault();
    }


    
}
