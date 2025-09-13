<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Setting extends Model
{

    use HasFactory;
    
    protected $fillable = [
        'currency',
        'email',
        'logo',
        'company_name',
        'company_phone',
        'pdf_footer',
        'developer',
        'app_name',
        'footer',
        'language',
        'customer_id',
        'warehouse_id',
        'company_address',
    ];
}
