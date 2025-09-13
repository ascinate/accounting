<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Model
{
   
    use HasFactory;

    public $timestamps = false;  
    
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_image',
        'role_id',
        'status',
        'warehouse',
        
    ];
}
