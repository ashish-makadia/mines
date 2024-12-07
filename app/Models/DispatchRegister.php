<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DispatchRegister extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function mines()
    {
        return $this->belongsTo(Mine::class, 'mine_id')->withDefault();
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'issued_by')->withDefault();
    }
    public function assetscategory()
    {
        return $this->belongsTo(AssetCategroy::class, 'issued_assets')->withDefault();
    }
    public function assets()
    {
        return $this->belongsTo(Machinary_assets_list::class, 'assets_name')->withDefault();
    }
}
