<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetsStock extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function workingAssets()
    {
        return $this->belongsTo(AssetCategroy::class, 'working_assets')->withDefault();
    }
    public function assets()
    {
        return $this->belongsTo(Machinary_assets_list::class, 'item_name')->withDefault();
    }
}
