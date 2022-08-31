<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'vehicle_type_id',
        'vehicle_type',
        'status'
    ];

    protected $casts = [
        'integer' => 'user_id',
        'integer' => 'vehicle_type_id',
        'integer' => 'status'
    ];
}
