<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $fillable = [
        'total_price',
        'status',
        'created_by',
        'updated_by'
    ];

    use HasFactory;
}
