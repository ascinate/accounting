<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $table = 'admins'; 
    protected $primaryKey = 'id'; 
    public $timestamps = false; 

    protected $fillable = [
        
        'payment_email',
      
    ];
}
