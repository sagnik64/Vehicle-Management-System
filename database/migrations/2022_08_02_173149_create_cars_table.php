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
            $table->string('brand');
            $table->string('transmission');
            $table->string('model');
            $table->integer('model_year');
            $table->integer('seating_capacity');
            $table->string('fuel_type');
            $table->integer('fuel_tank_capacity_litres');
            $table->integer('mileage_kmpl');
            $table->integer('engine_displacement_cc');
            $table->string('body_type');
            $table->integer('wheel_base_mm')->nullable();
            $table->integer('rpm')->nullable();
            $table->integer('max_power_bhp')->nullable();
            $table->integer('max_torque_nm')->nullable();
            $table->integer('length_mm')->nullable();
            $table->integer('width_mm')->nullable();
            $table->integer('height_mm')->nullable();
            $table->string('vin');
            $table->string('engine_number');
            $table->integer('price_rs');
            $table->integer('colors_available')->default(3);
            $table->integer('wheel_count')->default(4);
            $table->integer('record_status')->default(1);
            $table->integer('user_id')->nullable();
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
