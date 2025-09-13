<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    protected $table = 'saledetails';

    public $timestamps = false;

    protected $fillable = [
        'saleid',
        'productid',
        'quantity',
        'price',
        'TotalPrice',
    ];

    public function sale()
    {
        return $this->belongsTo(Sale::class, 'saleid');
    }

}
