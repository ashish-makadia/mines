<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceGenerate extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function customers(){
        return $this->belongsTo(Customer_Managment::class, 'customer_id')->withDefault();
    }
    public function shippers()
    {
        return $this->belongsTo(Vendor_Managment::class, 'consignee_id')->with(["state","city"]);
    }
    public function buyers()
    {
        return $this->belongsTo(Vendor_Managment::class, 'buyer_id')->with(["state","city"]);
    }
    public function mines()
    {
        return $this->belongsTo(Mine::class, 'mine_id')->with(["state","city"]);
    }
    public function wip()
    {
        return $this->belongsTo(SellRegister::class, 'sell_id')->with("sellItem");
    }

}
