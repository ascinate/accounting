<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Accounting extends Model
{
    protected $table = 'accounting';

    public $timestamps = false;

    protected $fillable = [
        'EntryDate',
        'EntryType',
        'Description',
        'Amount',
    ];
}
