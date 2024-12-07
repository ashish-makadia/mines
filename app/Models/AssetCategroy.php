<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetCategroy extends Model
{
    use HasFactory;
protected $table = 'asset_categories';
    public $timestamps = false;
 
    protected $fillable = [
        'category_name',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'deleted_at',
        'deleted_by',
        'is_active'
    ];
    // public function getCategoryData()
    // {
    //     return $this->belongsTo(State::class, 'state_id')->withDefault();
    // }

    // public function citydata()
    // {
    //     return $this->belongsTo(City::class, 'city_id')->withDefault();
    // }
}
