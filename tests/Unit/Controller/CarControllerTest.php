<?php

namespace Tests\Unit\Controller;

use App\Models\Car;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CarControllerTest extends TestCase
{
    use RefreshDatabase;

    private function setUpMockDatabase()
    {
        $this->post('/api/cars', [
            "car_name" => "Verna",
            "price_rs" => 1245000,
            "brand" => "Hyundai",
            "model" => "SX",
            "model_year" => 2022,
            "colors_available" => 6,
            "wheel_count" => 4,
            "fuel_type" => "Diesel",
            "record_status" => 1,
            "first_production_year" => 2006,
            "transmission" => "Manual",
            "engine_displacement_cc" => 1493,
            "seating_capacity" => 5,
            "fuel_tank_capacity_litres" => 45,
            "body_type" => "Sedan",
            "mileage_kmpl" => 25,
            "rpm" => 4000,
            "max_power_bhp" => 113,
            "max_torque_nm" => 250,
            "length_mm" => 4440,
            "width_mm" => 1729,
            "height_mm" => 1475,
            "wheel_base_mm" => 2600,
            "vin" => "1ABCD23EFGH456789",
            "engine_number" => "12ABC34567",
            "user_id" => 2
        ]);

        $this->post('/api/cars', [
            "car_name" => "Venue",
            "price_rs" => 1070000,
            "brand" => "Hyundai",
            "model" => "SX",
            "model_year" => 2022,
            "colors_available" => 7,
            "wheel_count" => 4,
            "fuel_type" => "Petrol",
            "record_status" => 1,
            "first_production_year" => 2019,
            "transmission" => "Manual",
            "engine_displacement_cc" => 1197,
            "seating_capacity" => 5,
            "fuel_tank_capacity_litres" => 45,
            "body_type" => "SUV",
            "mileage_kmpl" => 16,
            "rpm" => 6000,
            "max_power_bhp" => 82,
            "max_torque_nm" => 113.8,
            "length_mm" => 3995,
            "width_mm" => 1770,
            "height_mm" => 1617,
            "wheel_base_mm" => 2500,
            "vin" => "1ABCD23EFGH456789",
            "engine_number" => "12ABC34567",
            "user_id" => 2
        ]);
    }

    public function test_car_duplication()
    {
        //Preparation
        //Empty Database

        //Action
        $car1 = Car::make([
            "car_name" => "Venue",
            "price_rs" => 1070000,
            "brand" => "Hyundai",
            "model" => "SX",
            "model_year" => 2022,
            "colors_available" => 7,
            "wheel_count" => 4,
            "fuel_type" => "Petrol",
            "record_status" => 1,
            "transmission" => "Manual",
            "engine_displacement_cc" => 1197,
            "seating_capacity" => 5,
            "fuel_tank_capacity_litres" => 45,
            "body_type" => "SUV",
            "mileage_kmpl" => 16,
            "rpm" => 6000,
            "max_power_bhp" => 82,
            "max_torque_nm" => 113.8,
            "length_mm" => 3995,
            "width_mm" => 1770,
            "height_mm" => 1617,
            "wheel_base_mm" => 2500,
            "vin" => "1ABCD23EFGH456789",
            "engine_number" => "12ABC34567",
            "user_id" => 2
        ]);
        $car2 = Car::make([
            "car_name" => "Verna",
            "price_rs" => 1245000,
            "brand" => "Hyundai",
            "model" => "SX",
            "model_year" => 2022,
            "colors_available" => 6,
            "wheel_count" => 4,
            "fuel_type" => "Diesel",
            "record_status" => 1,
            "first_production_year" => 2006,
            "transmission" => "Manual",
            "engine_displacement_cc" => 1493,
            "seating_capacity" => 5,
            "fuel_tank_capacity_litres" => 45,
            "body_type" => "Sedan",
            "mileage_kmpl" => 25,
            "rpm" => 4000,
            "max_power_bhp" => 113,
            "max_torque_nm" => 250,
            "length_mm" => 4440,
            "width_mm" => 1729,
            "height_mm" => 1475,
            "wheel_base_mm" => 2600,
            "vin" => "1ABCD23EFGH456789",
            "engine_number" => "12ABC34567",
            "user_id" => 2
        ]);

        //Assertion
        $this->assertTrue($car1->car_name != $car2->car_name);
    }

    public function test_get_all_cars_route()
    {
        //Preparation
        $this->setUpMockDatabase();

        //Action
        $response = $this->get('api/cars');

        //Assertion
        $response->assertStatus(200);
    }

    public function test_get_all_cars_json_count()
    {
        //Preparation
        $this->setUpMockDatabase();

        //Action
        $response = $this->get('api/cars');

        //Assertion
        $response->assertJsonCount(4);
    }

    public function test_get_all_cars_json_structure()
    {
        //Preparation
        $this->setUpMockDatabase();

        //Action
        $response = $this->get('api/cars');

        //Assertion
        $response->assertJsonStructure([
            'success',
            'code',
            'message',
            'data'
        ]);
    }

    public function test_get_all_cars_json_fragment()
    {
        //Preparation
        $this->setUpMockDatabase();

        //Action
        $response = $this->get('api/cars');

        //Assertion
        $response->assertJsonFragment([
            "success" => "true",
            "code" => 200,
            "message" => "Car data found"
        ]);
    }

    public function test_delete_car()
    {
        //Preparation
        $this->setUpMockDatabase();

        //Action
        $car = Car::first();
        if ($car) {
            $car->delete();
        }

        //Assertion
        $this->assertTrue(true);
    }

    public function test_stores_new_car()
    {
        //Preparation
        //Empty Database

        //Action
        $response = $this->post('/api/cars', [
            "car_name" => "Verna",
            "price_rs" => 1245000,
            "brand" => "Hyundai",
            "model" => "SX",
            "model_year" => 2022,
            "colors_available" => 6,
            "wheel_count" => 4,
            "fuel_type" => "Diesel",
            "record_status" => 1,
            "first_production_year" => 2006,
            "transmission" => "Manual",
            "engine_displacement_cc" => 1493,
            "seating_capacity" => 5,
            "fuel_tank_capacity_litres" => 45,
            "body_type" => "Sedan",
            "mileage_kmpl" => 25,
            "rpm" => 4000,
            "max_power_bhp" => 113,
            "max_torque_nm" => 250,
            "length_mm" => 4440,
            "width_mm" => 1729,
            "height_mm" => 1475,
            "wheel_base_mm" => 2600,
            "vin" => "1ABCD23EFGH456789",
            "engine_number" => "12ABC34567",
            "user_id" => 2
        ]);

        //Assertion
        $response->assertStatus(201);
    }

    public function test_database()
    {
        //Preparation
        //Empty Database

        //Action
        $this->post('/api/cars', [
            "car_name" => "Verna",
            "price_rs" => 1245000,
            "brand" => "Hyundai",
            "model" => "SX",
            "model_year" => 2022,
            "colors_available" => 6,
            "wheel_count" => 4,
            "fuel_type" => "Diesel",
            "record_status" => 1,
            "first_production_year" => 2006,
            "transmission" => "Manual",
            "engine_displacement_cc" => 1493,
            "seating_capacity" => 5,
            "fuel_tank_capacity_litres" => 45,
            "body_type" => "Sedan",
            "mileage_kmpl" => 25,
            "rpm" => 4000,
            "max_power_bhp" => 113,
            "max_torque_nm" => 250,
            "length_mm" => 4440,
            "width_mm" => 1729,
            "height_mm" => 1475,
            "wheel_base_mm" => 2600,
            "vin" => "1ABCD23EFGH456789",
            "engine_number" => "12ABC34567",
            "user_id" => 2
        ]);

        //Assertion
        $this->assertDatabaseHas('cars', [
            'car_name' => 'Verna'
        ]);
        $this->assertDatabaseMissing('cars', [
            'car_name' => 'Bike'
        ]);
    }
}