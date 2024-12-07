<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assign_Assets extends Model
{
    use HasFactory,SoftDeletes;
 protected $table="assign_assets";

 public function mine()
 {
     return $this->belongsTo(Mine::class, 'mine_id')->withDefault();
 }

 public function category()
    {
        return $this->belongsTo(AssetCategroy::class, 'asset_category_id')->withDefault();
    }
    
public function assets()
    {
        return $this->belongsTo(Machinary_assets_list::class, 'assets_name')->withDefault();
    }
   
}
