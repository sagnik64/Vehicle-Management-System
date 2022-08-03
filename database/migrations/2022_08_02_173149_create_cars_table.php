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
            $table->decimal('price_(rs)');
            $table->string('brand');
            $table->string('model');
            $table->integer('model_year');
            $table->integer('colors_available');
            $table->integer('wheel_count');
            $table->string('fuel_type');
            $table->integer('record_status');
            $table->integer('first_production_year');
            $table->string('transmission');
            $table->integer('engine_displacement_(cc)');
            $table->integer('seating_capacity');
            $table->decimal('fuel_tank_capacity_(litres)');
            $table->string('body_type');
            $table->integer('mileage_(kmpl)');
            $table->integer('rpm');
            $table->integer('max_power_(bhp)');
            $table->integer('max_torque_(nm)');
            $table->integer('length_(mm)');
            $table->integer('width_(mm)');
            $table->integer('height_(mm)');
            $table->integer('wheel_base_(mm)');
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
