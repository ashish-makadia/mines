<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Mine extends Model
{
    use HasFactory, SoftDeletes;

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id')->withDefault();
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id')->withDefault();
    }
}
