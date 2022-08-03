<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bikes', function (Blueprint $table) {
            $table->id()->from(501);
            $table->string('bike_name');
            $table->string('brand');
            $table->string('model');
            $table->string('colour');
            $table->string('fuel_type');
            $table->string('front_break_type');
            $table->string('rear_break_type');
            $table->string('tyre_type');
            $table->string('wheel_type');
            $table->string('speedometer_type');
            $table->string('odometer_type');
            $table->string('fuel_guage_type');
            $table->string('max_Power');
            $table->string('max_Torque');
            $table->integer('model_year');
            $table->integer('gear_count');
            $table->integer('kmpl_mileage');
            $table->integer('engine_displacement_cc');
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
        Schema::dropIfExists('bikes');
    }
}
