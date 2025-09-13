<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    //public $timestamps = false; 
    protected $fillable = [
        'name',
        'code',
        'category',
        'brand',
        'gst',
        'taxmethod',
        'type',
        'image',
        'otherdetails',
        'price',
        'unit_name',
        'unit_sale',
        'unit_purchase',
        'quantity',
        'stock_alert',
    ];
}
