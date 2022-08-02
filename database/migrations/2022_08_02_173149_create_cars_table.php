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
            $table->id()->from(1001);
            $table->string('name');
            $table->string('brand');
            $table->string('model');
            $table->string('colour');
            $table->string('transmission');
            $table->string('fuel_type');
            $table->string('front_break_type');
            $table->string('rear_break_type');
            $table->string('Max_Power');
            $table->string('Max_Torque');
            $table->string('body_type');
            $table->integer('model_year');
            $table->integer('kmpl_mileage');
            $table->integer('engine_displacement_cc');
            $table->integer('seating_capacity');
            $table->integer('fuel_tank_capacity');
            $table->integer('length');
            $table->integer('width');
            $table->integer('height');
            $table->integer('price');
            $table->integer('dealer_id');
            $table->integer('status');
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
