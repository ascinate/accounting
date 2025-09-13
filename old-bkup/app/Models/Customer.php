<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Customer extends Model
{

    public $timestamps = false;  

    protected $fillable = [
        'name',
        'email',
        'phone',
        'image',
        'address',
        'city', 
    ];

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

}
