<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
    protected $fillable = [
        'type_name',
        'type_id',
        'added_by_user_id',
        'status'
    ];

    protected $casts = [
        'integer' => 'type_id',
        'integer' => 'added_by_user_id',
        'integer' => 'status'
    ];
}
