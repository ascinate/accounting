<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    public $timestamps = false; 
    protected $fillable = [
        'date',
        'supplier_id',
        'warehouse_id',
        'product_id',
        'tax',
        'discount',
        'shipping',
        'other_details',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'purchaseid');
    }
    public function purchaseDetails()
    {
        return $this->hasMany(PurchaseDetail::class, 'purchaseid');
    }
}
