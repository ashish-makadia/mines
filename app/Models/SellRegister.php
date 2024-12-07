<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellRegister extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function users()
    {
        return $this->belongsTo(User::class, 'sold_by')->withDefault();
    }
    public function wip()
    {
        return $this->belongsTo(Wip::class, 'wip_no')->withDefault();
    }
    public function parties()
    {
        return $this->belongsTo(Vendor_Managment::class, 'party_name')->withDefault();
    }
    public function sellItem()
    {
        return $this->hasMany(wipSellItem::class, 'sell_id')->with("wip_step3");
    }
    public function quc()
    {
        return $this->belongsTo(Quc::class, 'volume')->withDefault();
    }
}
