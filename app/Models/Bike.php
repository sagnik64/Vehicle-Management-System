<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bike extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'bike_name',
        'brand',
        'model',
        'model_year',
        'colour',
        'engine_id',
        'engine_displacement_cc',
        'kmpl_mileage',
        'gear_count',
        'fuel_tank_capacity',
        'front_break_type',
        'rear_break_type',
        'max_power',
        'max_torque',
        'speedometer_type',
        'odometer_type',
        'width',
        'length',
        'height',
        'wheel_base',
        'on_road_price',
        'dealer_id',
        'record_status'
    ];


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'integer' => 'model_year',
        'integer' => 'engine_displacement_cc',
        'integer' => 'kmpl_mileage',
        'integer' => 'gear_count',
        'integer' => 'fuel_tank_capacity',
        'integer' => 'width',
        'integer' => 'length',
        'integer' => 'height',
        'integer' => 'wheel_base',
        'integer' => 'on_road_price',
        'integer' => 'dealer_id',
        'integer' => 'record_status',
    ];
}
