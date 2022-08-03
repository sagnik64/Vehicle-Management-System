<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'car_name',
        'price_rs',
        'brand',
        'model',
        'model_year',
        'colors_available',
        'wheel_count',
        'fuel_type',
        'record_status',
        'first_production_year',
        'transmission',
        'engine_displacement_cc',
        'seating_capacity',
        'fuel_tank_capacity_litres',
        'body_type',
        'mileage_kmpl',
        'rpm',
        'max_power_bhp',
        'max_torque_nm',
        'length_mm',
        'width_mm',
        'height_mm',
        'wheel_base_mm'

    ];
    protected $casts = [
        'integer' => 'price_rs',
        'integer' => 'model_year',
        'integer' => 'colors_available',
        'integer' => 'wheel_count',
        'integer' => 'record_status',
        'decimal' => 'first_production_year',
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
        'integer' => 'wheel_base_mm'
    ];
    use HasFactory;
}
