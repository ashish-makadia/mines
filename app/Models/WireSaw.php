<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WireSaw extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function quc()
    {
        return $this->belongsTo(Quc::class, 'quc_id')->withDefault();
    }
}
