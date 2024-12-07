<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale_Assets extends Model
{
    use HasFactory;
    protected $table ="sale_assets";
    protected $guarded = [];
    protected $appends = [
        'sales_assets_type',
    ];
    public function assetscategory()
    {
        return $this->belongsTo(AssetCategroy::class, 'assets_category')->withDefault();
    }
    public function getSalesAssetsTypeAttribute()
    {
        if (isset($this->attributes['assets_type'])) {
            $assets_type = Config("constantArr.assetsType");
            return $assets_type[$this->attributes['assets_type']];
        }
    }
     public function mines()
    {
        return $this->belongsTo(Mine::class, 'mine_id')->withDefault();
    }
      public function transferMines()
    {
        return $this->belongsTo(Mine::class, 'transfer_mine_name')->withDefault();
    }
        
public function assets()
    {
        return $this->belongsTo(Machinary_assets_list::class, 'assets_name')->withDefault();
    }
}
