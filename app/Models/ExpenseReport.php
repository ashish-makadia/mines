<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseReport extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table ="expense_report";
    public function employees()
    {
        return $this->belongsTo(Employee::class, 'employee_id')->withDefault();
    }
    public function categories()
    {
        return $this->belongsTo(ExpenseCategory::class, 'category_id')->withDefault();
    }
}
