<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseDetail extends Model
{
    protected $table = 'purchasedetails';

    public $timestamps = false;

    protected $fillable = [
        'purchaseid',
        'productid',
        'quantity',
        'price',
        'totalprice',
    ];

    public function purchase()
    {
        return $this->belongsTo(Purchase::class, 'purchaseid');
    }
}
