<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adjustment extends Model
{
    use HasFactory;

    protected $table = 'adjustments';

    protected $fillable = [
        'date',
        'ref_id',
        'warehouse_id',
        'product_id',
        'total_products',
        'details',
    ];

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id');
    }

  
}

