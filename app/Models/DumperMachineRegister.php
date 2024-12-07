<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DumperMachineRegister extends Model
{
    use HasFactory, SoftDeletes;

    protected $table="dumper_machine_register";

    protected $guarded = [];


    public function assetcategroy()
    {
        return $this->belongsTo(AssetCategroy::class, 'asset_id')->withDefault();
    }
    public function assets()
    {
        return $this->belongsTo(Machinary_assets_list::class, 'assets_name')->withDefault();
    }
}
