<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transfer extends Model
{
    use HasFactory;

  
    protected $table = 'transfers';

 
    protected $fillable = [
        'date',
        'from_warehouse',
        'to_warehouse',
        'tax',
        'discount',
        'shipping',
        'otherdetails',
    ];
}
