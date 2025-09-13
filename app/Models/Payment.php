<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';

    protected $fillable = [
        'saleid',
        'amount_paid',
        'purchaseid'
    ];

    public function sale()
    {
        return $this->belongsTo(Sale::class, 'saleid');
    }
    public function purchase()
    {
        return $this->belongsTo(Purchase::class, 'purchaseid');
    }
}
