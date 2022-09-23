<?php

namespace Tests\Unit\Controller;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Illuminate\Support\Facades\Session;

use function PHPUnit\Framework\assertJson;

class UserControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    private function setUpMockDatabase() {
        $this->post('/api/users', [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'phone' => '9988123450' ,
            'address' => $this->faker()->address(),
            'email' => $this->faker()->safeEmail(),
            'password' => $this->faker()->randomNumber(5),
            'user_type' => 1,
            'interest' => 1
        ]);
        $this->post('/api/users', [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'phone' => '9988123451' ,
            'address' => $this->faker()->address(),
            'email' => $this->faker()->safeEmail(),
            'password' => $this->faker()->randomNumber(5),
            'user_type' => 2,
            'interest' => 1
        ]);
        $this->post('/api/users', [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'phone' => '9988123452' ,
            'address' => $this->faker()->address(),
            'email' => $this->faker()->safeEmail(),
            'password' => $this->faker()->randomNumber(5),
            'user_type' => 3,
            'interest' => 2
        ]);
        $this->post('/api/users', [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'phone' => '9988123453' ,
            'address' => $this->faker()->address(),
            'email' => $this->faker()->safeEmail(),
            'password' => $this->faker()->randomNumber(5),
            'user_type' => 3,
            'interest' => 2
        ]);
        $this->post('/api/users', [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'phone' => '9988123454' ,
            'address' => $this->faker()->address(),
            'email' => $this->faker()->safeEmail(),
            'password' => $this->faker()->randomNumber(5),
            'user_type' => 3,
            'interest' => 2
        ]);
        $this->post('/api/users', [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'phone' => '9988123455' ,
            'address' => $this->faker()->address(),
            'email' => $this->faker()->safeEmail(),
            'password' => $this->faker()->randomNumber(5),
            'user_type' => 1,
            'interest' => 1
        ]);
        $this->post('/api/users', [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'phone' => '9988123456' ,
            'address' => $this->faker()->address(),
            'email' => $this->faker()->safeEmail(),
            'password' => $this->faker()->randomNumber(5),
            'user_type' => 1,
            'interest' => 1
        ]);
    }

    public function test_get_all_users_route()
    {
        //Preparation
        $this->setUpMockDatabase();

        //Action
        $response = $this->get('api/users');
        
        //Assertion
        $response->assertStatus(200);
    }

    public function test_get_all_users_json_count()
    {
        //Preparation
        $this->setUpMockDatabase();
        
        //Action
        $response = $this->get('api/users');

        //Assertion
        $response->assertJsonCount(4);
    }
    public function test_get_all_users_json_structure()
    {
        //Preparation
        $this->setUpMockDatabase();
        
        //Action
        $response = $this->get('api/users');
        
        //Assertion
        $response->assertJsonStructure([
            'success',
            'code',
            'message',
            'data'
        ]);
    }

    public function test_get_all_users_json_fragment()
    {
        //Preparation
        $this->setUpMockDatabase();
        
        //Action
        $response = $this->get('api/users');
        
        //Assertion
        $response->assertJsonFragment([
            "success" => "true",
            "code" => 200,
            "message" => "User data found"
        ]);

    }

    public function test_get_all_users_json_missing()
    {
        //Preparation
        $this->setUpMockDatabase();
        
        //Action
        $response = $this->get('api/users');

        //Assertion
        $response->assertJsonMissing([
            "status" => "fail",
            "message" => "User data not found"
        ]);
    }

    public function test_get_user_by_id_route()
    {
        //Preparation
        $this->setUpMockDatabase();
        
        //Action
        $response = $this->get('api/users/1');
        
        //Assertion    
        $response->assertStatus(200);
    }

    public function test_get_all_admin_users()
    {
        //Preparation
        $this->setUpMockDatabase();

        //Action
        $response = $this->get('api/users?type=admin');
        
        //Assertion 
        $response
        ->assertJsonCount(4)
        ->assertJsonFragment([
            'user_type' => 3
        ]);
    }

    public function test_get_all_dealer_users()
    {
        //Preparation
        $this->setUpMockDatabase();

        //Action
        $response = $this->get('api/users?type=dealer');
        
        //Assertion 
        $response
        ->assertJsonCount(4)
        ->assertJsonFragment([
            'user_type' => 2
        ]);
    }

    public function test_get_all_customer_users()
    {
        //Preparation
        $this->setUpMockDatabase();

        //Action
        $response = $this->get('api/users?type=customer');
        
        //Assertion 
        $response
        ->assertJsonCount(4)
        ->assertJsonFragment([
            'user_type' => 1
        ]);
    }

    public function test_registers_new_user()
    {
        //Preparation
            //Empty Database

        //Action    
        $response = $this->post('/api/users', [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'phone' => "9988123450" ,
            'address' => $this->faker()->address(),
            'email' => $this->faker()->safeEmail(),
            'password' => $this->faker()->randomNumber(5),
            'user_type' => 1,
            'interest' => 1
        ]);
        
        //Assertion 
        $response->assertStatus(201);
    }

    public function test_user_login_as_customer_user()
    {
        //Preparation
        $email1 = $this->faker()->safeEmail();
        $email2 = $this->faker()->safeEmail();
        $email3 = $this->faker()->safeEmail();
        $password1 = $this->faker()->randomNumber(5);
        $password2 = $this->faker()->randomNumber(5);
        $password3 = $this->faker()->randomNumber(5);

        $this->post('/api/users', [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'phone' => '9988123450' ,
            'address' => $this->faker()->address(),
            'email' => $email1,
            'password' => $password1,
            'user_type' => 1,
            'interest' => 1
        ])->assertCreated();
        
        $this->post('/api/users', [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'phone' => '9988123450' ,
            'address' => $this->faker()->address(),
            'email' => $email2,
            'password' => $password2,
            'user_type' => 2,
            'interest' => 1
        ])->assertCreated();
        
        $this->post('/api/users', [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'phone' => '9988123450' ,
            'address' => $this->faker()->address(),
            'email' => $email3,
            'password' => $password3,
            'user_type' => 3,
            'interest' => 1
        ])->assertCreated();
   
        //Action
        $this->get('/login')->assertViewIs('login');
        Session::start();
        $response = $this->call('POST', 'user_login', [
            'email' => $email1,
            'password' => $password1,
            '_token' => csrf_token()
        ]);
        
        //Assertion
        $response->assertRedirect('profile/customer');
    }

    public function test_user_login_as_dealer_user()
    {

        //Preparation
        $email1 = $this->faker()->safeEmail();
        $email2 = $this->faker()->safeEmail();
        $email3 = $this->faker()->safeEmail();
        $password1 = $this->faker()->randomNumber(5);
        $password2 = $this->faker()->randomNumber(5);
        $password3 = $this->faker()->randomNumber(5);

        $this->post('/api/users', [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'phone' => '9988123450' ,
            'address' => $this->faker()->address(),
            'email' => $email1,
            'password' => $password1,
            'user_type' => 1,
            'interest' => 1
        ])->assertCreated();
        
        $this->post('/api/users', [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'phone' => '9988123450' ,
            'address' => $this->faker()->address(),
            'email' => $email2,
            'password' => $password2,
            'user_type' => 2,
            'interest' => 1
        ])->assertCreated();
        
        $this->post('/api/users', [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'phone' => '9988123450' ,
            'address' => $this->faker()->address(),
            'email' => $email3,
            'password' => $password3,
            'user_type' => 3,
            'interest' => 1
        ])->assertCreated();
   
        //Action
        $this->get('/login')->assertViewIs('login');
        Session::start();
        $response = $this->call('POST', 'user_login', [
            'email' => $email2,
            'password' => $password2,
            '_token' => csrf_token()
        ]);
        
        //Assertion
        $response->assertRedirect('profile/dealer');
    }

    public function test_user_login_as_admin_user()
    {

        //Preparation
        $email1 = $this->faker()->safeEmail();
        $email2 = $this->faker()->safeEmail();
        $email3 = $this->faker()->safeEmail();
        $password1 = $this->faker()->randomNumber(5);
        $password2 = $this->faker()->randomNumber(5);
        $password3 = $this->faker()->randomNumber(5);

        $this->post('/api/users', [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'phone' => '9988123450' ,
            'address' => $this->faker()->address(),
            'email' => $email1,
            'password' => $password1,
            'user_type' => 1,
            'interest' => 1
        ])->assertCreated();
        
        $this->post('/api/users', [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'phone' => '9988123450' ,
            'address' => $this->faker()->address(),
            'email' => $email2,
            'password' => $password2,
            'user_type' => 2,
            'interest' => 1
        ])->assertCreated();
        
        $this->post('/api/users', [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'phone' => '9988123450' ,
            'address' => $this->faker()->address(),
            'email' => $email3,
            'password' => $password3,
            'user_type' => 3,
            'interest' => 1
        ])->assertCreated();
   
        //Action
        $this->get('/login')->assertViewIs('login');
        Session::start();
        $response = $this->call('POST', 'user_login', [
            'email' => $email3,
            'password' => $password3,
            '_token' => csrf_token()
        ]);
        
        //Assertion
        $response->assertRedirect('profile/admin');
    }

    
    public function test_updates_existing_user_by_id()
    {
        
        //Preparation
        $this->setUpMockDatabase();

        //Action
        $response = $this->put('/api/users/1', [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'phone' => "9988123880" ,
            'address' => $this->faker()->address(),
            'email' => $this->faker()->safeEmail(),
            'password' => $this->faker()->randomNumber(5),
            'user_type' => 1,
            'interest' => 1
        ]);

        //Assertion
        $response
        ->assertStatus(200)
        ->assertJsonCount(4)
        ->assertJsonFragment([
            'phone' => "9988123880"
        ]);
    }
}
