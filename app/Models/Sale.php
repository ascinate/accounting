<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sale extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'customerid',
        'warehouseid',
        'product_id',
        'date',
        'tax',
        'discount',
        'shipping',
        'otherdetails',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'saleid');
    }
    public function saledetails()
    {
        return $this->hasMany(SaleDetail::class, 'saleid');
    }


}
