<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WipStock extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table="wip_stock";
}
