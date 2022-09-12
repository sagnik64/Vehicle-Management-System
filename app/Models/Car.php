<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'car_name',
        'brand',
        'transmission',
        'model',
        'model_year',
        'seating_capacity',
        'fuel_type',
        'fuel_tank_capacity_litres',
        'mileage_kmpl',
        'engine_displacement_cc',
        'body_type',
        'wheel_base_mm',
        'rpm',
        'max_power_bhp',
        'max_torque_nm',
        'length_mm',
        'width_mm',
        'height_mm',
        'vin',
        'engine_number',
        'price_rs',
        'colors_available',
        'wheel_count',
        'record_status',
        'user_id',

    ];
    protected $casts = [
        'integer' => 'price_rs',
        'integer' => 'model_year',
        'integer' => 'colors_available',
        'integer' => 'wheel_count',
        'integer' => 'record_status',
        'integer' => 'engine_displacement_cc',
        'integer' => 'seating_capacity',
        'decimal' => 'fuel_tank_capacity_litres',
        'integer' => 'mileage_kmpl',
        'integer' => 'rpm',
        'integer' => 'max_power_bhp',
        'integer' => 'max_torque_nm',
        'integer' => 'length_mm',
        'integer' => 'width_mm',
        'integer' => 'height_mm',
        'integer' => 'wheel_base_mm',
        'integer' => 'user_id'
    ];
    use HasFactory;
}
