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

    /**
     * Get the role associated with the user.
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    /**
     * Accessor to get the role name directly
     */
    public function getRoleAttribute()
    {
        return $this->role->name ?? null;
    }
}