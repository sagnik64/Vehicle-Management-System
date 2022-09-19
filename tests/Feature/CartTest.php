<?php

namespace Tests\Feature;

use App\Models\Car;
use Tests\TestCase;
use App\Models\Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CartTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    private function setUpDatabase() {
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
        ])->assertCreated();

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
        ])->assertCreated();
    }

    private function user_login_as_customer_user() {

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
        ])->assertCreated();;
        
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

    private function addToCartMock() {
        $this->call('POST', route('cart.store'), [
            'user_id' => 1,
            'vehicle_type_id' => 1,
            'vehicle_type' => 'car',
            'status' => 0,
            '_token' => csrf_token()
        ])->assertCreated();

        $this->call('POST', route('cart.store'), [
            'user_id' => 1,
            'vehicle_type_id' => 2,
            'vehicle_type' => 'car',
            'status' => 0,
            '_token' => csrf_token()
        ])->assertCreated();
    }

    public function test_add_to_cart_button_is_visible_in_view()
    {
        $this->setUpDatabase();
        $this->user_login_as_customer_user();
        $cars = Car::all();
        $data = compact('cars');
        $view = $this->view('profile/customer',$data);
        $view->assertSee('Add to Cart')->assertDontSee('Remove from Cart');
    }

    public function test_remove_from_cart_button_is_visible_in_view()
    {
        $this->setUpDatabase();

        $this->addToCartMock();

        $this->user_login_as_customer_user();

        
        $cars = Car::all();
        $data = compact('cars');
        $view = $this->view('profile/customer',$data);
        $view->assertSee('Remove from Cart')->assertDontSee('Add to Cart');
    }
    
    public function test_count_of_all_add_to_cart_buttons_are_according_to_database() {
        $this->setUpDatabase();

        $this->user_login_as_customer_user();

        $addedToCartCount = Cart::where('status','=',1)->get()->count();
        $this->assertEquals(0,$addedToCartCount);

    }

    public function test_count_of_all_remove_from_cart_buttons_are_according_to_database() {
        $this->setUpDatabase();

        //Add two items in cart
        $this->addToCartMock();

        $this->user_login_as_customer_user();

        $addedToCartCount = Cart::where('status','=',1)->get()->count();
        $this->assertEquals(2,$addedToCartCount);
    }

    public function test_my_cart_link_shows_list_of_all_cart_items_of_user() {
        $this->setUpDatabase();

        //Add two items in cart
        $this->addToCartMock();

        $this->user_login_as_customer_user();

        $this->get('api/cart/1')->assertOk();
    }
}
