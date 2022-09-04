<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'vehicle_type_id',
        'vehicle_type',
        'customer_user_id',
        'dealer_user_id',
        'payment_mode',
        'payment_received',
        'added_on',
        'status'
    ];

    protected $casts = [
        'integer' => 'vehicle_type_id',
        'integer' => 'customer_user_id',
        'integer' => 'dealer_user_id',
        'integer' => 'payment_mode',
        'boolean' => 'payment_received',
        'date' => 'added_on',
        'integer' => 'status'
    ];
}