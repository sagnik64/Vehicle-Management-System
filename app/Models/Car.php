<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'car_name',
        'price_(rs)',
        'brand',
        'model',
        'model_year',
        'colors_available',
        'wheel_count',
        'fuel_type',
        'record_status',
        'first_production_year',
        'transmission',
        'engine_displacement_(cc)',
        'seating_capacity',
        'fuel_tank_capacity_(litres)',
        'body_type',
        'mileage_(kmpl)',
        'rpm',
        'max_power_(bhp)',
        'max_torque_(nm)',
        'length_(mm)',
        'width_(mm)',
        'height_(mm)',
        'wheel_base_(mm)'

    ];
    protected $casts = [
        'decimal' => 'price_(rs)',
        'integer' => 'model_year',
        'integer' => 'colors_available',
        'integer' => 'wheel_count',
        'integer' => 'record_status',
        'decimal' => 'first_production_year',
        'integer' => 'engine_displacement_(cc)',
        'integer' => 'seating_capacity',
        'decimal' => 'fuel_tank_capacity_(litres)',
        'integer' => 'mileage_(kmpl)',
        'integer' => 'rpm',
        'integer' => 'max_power_(bhp)',
        'integer' => 'max_torque_(nm)',
        'integer' => 'length_(mm)',
        'integer' => 'width_(mm)',
        'integer' => 'height_(mm)',
        'integer' => 'wheel_base_(mm)'
    ];
    use HasFactory;
}
