<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Expense extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'account_id',
        'category_id',
        'expense_ref',
        'date',
        'amount',
        'payment_method',
        'attachment',
        'otherdetails',
    ];
}
