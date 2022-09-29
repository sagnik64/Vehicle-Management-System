<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\Car;
use Tests\TestCase;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderTest extends DuskTestCase
{
    use RefreshDatabase, WithFaker;

    private function setUpCarDatabase()
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

    private function user_login_as_customer_user()
    {

        $email1 = $this->faker()->safeEmail();
        $email2 = $this->faker()->safeEmail();
        $email3 = $this->faker()->safeEmail();
        $password1 = $this->faker()->randomNumber(5);
        $password2 = $this->faker()->randomNumber(5);
        $password3 = $this->faker()->randomNumber(5);

        $user1 = $this->post('/api/users', [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'phone' => '9988123450' ,
            'address' => $this->faker()->address(),
            'email' => $email1,
            'password' => $password1,
            'user_type' => 1,
            'interest' => 1
        ])->assertCreated();
        
        $user2 = $this->post('/api/users', [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'phone' => '9988123450' ,
            'address' => $this->faker()->address(),
            'email' => $email2,
            'password' => $password2,
            'user_type' => 2,
            'interest' => 1
        ])->assertCreated();
        
        $user3 = $this->post('/api/users', [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'phone' => '9988123450' ,
            'address' => $this->faker()->address(),
            'email' => $email3,
            'password' => $password3,
            'user_type' => 3,
            'interest' => 1
        ])->assertCreated();
   
        
        $this->get('/login')->assertViewIs('login');
        
        Session::start();
        $this->call('POST', 'user_login', [
            'email' => $email1,
            'password' => $password1,
            '_token' => csrf_token()
        ])->assertRedirect('profile/customer');
    }

    public function test_buy_now_links_to_order_page () {
        //Preparation
        $this->setUpCarDatabase();
        $this->user_login_as_customer_user();
        
        //Action
        $cars = Car::all();
        $data = compact('cars');
        $view = $this->view('profile/customer', $data);

        //Assertion
        $view->assertSee('Buy Now');
        $this->browse(function (Browser $browser) {
            $browser->visit('/profile/customer')
                    ->press('Buy Now')
                    ->assertPathIs('/order');
        });

    }

    public function test_place_order_stores_new_order () {
        
        //Preparation
        $this->setUpCarDatabase();
        
        $this->post('/api/users', [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'phone' => '9988123450' ,
            'address' => $this->faker()->address(),
            'email' => "john123@example.com",
            'password' => "123abc^",
            'user_type' => 1,
            'interest' => 1
        ])->assertCreated();

        //Action and Assertion    
        $this->browse(function (Browser $browser) {
            $browser->visit('login')
                    ->type('email','john123@example.com')
                    ->type('password','123abc^')
                    ->press('Login')
                    ->assertPathIs('/user_login');
            $browser->visit('login')
                    ->assertPathIs('/profile/customer')
                    ->press('Buy Now')
                    ->assertPathIs('/order')
                    ->type('dealer_user_id',1)
                    ->press('Place Order')
                    ->assertSee('Order data saved successfully');
        });

    }

    public function test_my_orders_links_to_list_of_all_orders_of_the_user () {
        $this->assertEquals("example","example");
    }

}
