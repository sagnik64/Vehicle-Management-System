<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'vehicle_id',
        'dealer_id',
        'price',
        'tax_percentage',
        'discount_percentage',
        'total_amount',
        'payment_method',
        'transaction_id',
        'verified_by',
    ];
    protected $casts = [
        'integer' => 'order_id',
        'integer' => 'vehicle_id',
        'integer' => 'dealer_id',
        'decimal' => 'price',
        'decimal' => 'tax_percentage',
        'decimal' => 'discount_percentage',
        'decimal' => 'total_amount',
    ];
}
