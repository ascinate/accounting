<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Quotation extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'customer_id',
        'warehouse_id',
        'tax',
        'discount',
        'shipping',
        'otherdetails',
    ];
}
