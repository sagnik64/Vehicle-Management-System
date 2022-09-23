<?php

namespace database\migrations;

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
            $table->integer('model_year');
            $table->string('colour');
            $table->string('engine_id');
            $table->integer('engine_displacement_cc');
            $table->integer('kmpl_mileage');
            $table->integer('gear_count');
            $table->integer('fuel_tank_capacity');
            $table->string('front_break_type');
            $table->string('rear_break_type');
            $table->string('max_power');
            $table->string('max_torque');
            $table->string('speedometer_type');
            $table->string('odometer_type');
            $table->integer('width');
            $table->integer('length');
            $table->integer('height');
            $table->integer('wheel_base');
            $table->integer('on_road_price');
            $table->integer('dealer_id');
            $table->integer('record_status');
            ;
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
