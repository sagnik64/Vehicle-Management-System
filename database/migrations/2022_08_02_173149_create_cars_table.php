<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('car_name');
            $table->integer('price_rs');
            $table->string('brand');
            $table->string('model');
            $table->integer('model_year');
            $table->integer('colors_available');
            $table->integer('wheel_count');
            $table->string('fuel_type');
            $table->integer('record_status');
            $table->integer('first_production_year');
            $table->string('transmission');
            $table->integer('engine_displacement_cc');
            $table->integer('seating_capacity');
            $table->decimal('fuel_tank_capacity_litres');
            $table->string('body_type');
            $table->integer('mileage_kmpl');
            $table->integer('rpm');
            $table->integer('max_power_bhp');
            $table->integer('max_torque_nm');
            $table->integer('length_mm');
            $table->integer('width_mm');
            $table->integer('height_mm');
            $table->integer('wheel_base_mm');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
}
