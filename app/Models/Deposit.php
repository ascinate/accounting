<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_id',
        'category_id',
        'deposit_ref',
        'date',
        'amount',
        'payment_method',
        'attachment',
        'otherdetails',
    ];
}
