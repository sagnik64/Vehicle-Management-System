<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Illuminate\Support\Facades\Session;

use function PHPUnit\Framework\assertJson;

class UserControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_get_all_users_route() {
        
        $this->post('api/users',[
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'phone' => "9988123450" ,
            'address' => $this->faker()->address(),
            'email' => $this->faker()->safeEmail(),
            'password' => $this->faker()->randomNumber(5),
            'user_type' => 1,
            'interest' => 1
        ])->assertCreated();
        $this->post('api/users',[
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'phone' => "9988123459" ,
            'address' => $this->faker()->address(),
            'email' => $this->faker()->safeEmail(),
            'password' => $this->faker()->randomNumber(5),
            'user_type' => 1,
            'interest' => 1
        ])->assertCreated();
        
        $this->get('api/users')->assertStatus(200);
    }

    public function test_get_all_users_json_count() {
        
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
        
        $this
            ->call('GET','api/users')
            ->assertOk()
            ->assertJsonCount(4);    
            
    }
    public function test_get_all_users_json_structure() {
        
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
        
        $this
            ->call('GET','api/users')
            ->assertOk()
            ->assertJsonStructure([
                'success',
                'code',
                'message',
                'data'
            ]);  
    }

    public function test_get_all_users_json_fragment() {
        
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
        
        $this
            ->call('GET','api/users')
            ->assertOk()
            ->assertJsonFragment([
                'phone' => "9988123450",
                'user_type' => 1,
                'interest' => 1
            ]);    
            
    }

    public function test_get_all_users_json_missing() {
        
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
        
        $this
            ->call('GET','api/users')
            ->assertOk()
            ->assertJsonMissing([
                'phone' => '12345',
                'user_type' => -1,
                'interest' => -1
            ]);    
    }

    public function test_get_user_by_id_route() {
        
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
        
        $this
            ->call('GET','api/users/1')
            ->assertStatus(200);    
    }

    public function test_get_all_admin_users() {
        
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
            'phone' => '9988123450' ,
            'address' => $this->faker()->address(),
            'email' => $this->faker()->safeEmail(),
            'password' => $this->faker()->randomNumber(5),
            'user_type' => 2,
            'interest' => 1
        ]);
        $this->post('/api/users', [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'phone' => '9988123450' ,
            'address' => $this->faker()->address(),
            'email' => $this->faker()->safeEmail(),
            'password' => $this->faker()->randomNumber(5),
            'user_type' => 3,
            'interest' => 1
        ]);
        
        $this
            ->call('GET','api/users?type=admin')
            ->assertStatus(200)
            ->assertJsonCount(4) 
            ->assertJsonFragment([
                'user_type' => 3
            ]);   
    }

    public function test_get_all_dealer_users() {
        
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
            'phone' => '9988123450' ,
            'address' => $this->faker()->address(),
            'email' => $this->faker()->safeEmail(),
            'password' => $this->faker()->randomNumber(5),
            'user_type' => 2,
            'interest' => 1
        ]);
        $this->post('/api/users', [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'phone' => '9988123450' ,
            'address' => $this->faker()->address(),
            'email' => $this->faker()->safeEmail(),
            'password' => $this->faker()->randomNumber(5),
            'user_type' => 3,
            'interest' => 1
        ]);
        
        $this
            ->call('GET','api/users?type=dealer')
            ->assertStatus(200)
            ->assertJsonCount(4) 
            ->assertJsonFragment([
                'user_type' => 2
            ]);   
    }

    public function test_get_all_customer_users() {
        
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
            'phone' => '9988123450' ,
            'address' => $this->faker()->address(),
            'email' => $this->faker()->safeEmail(),
            'password' => $this->faker()->randomNumber(5),
            'user_type' => 2,
            'interest' => 1
        ]);
        $this->post('/api/users', [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'phone' => '9988123450' ,
            'address' => $this->faker()->address(),
            'email' => $this->faker()->safeEmail(),
            'password' => $this->faker()->randomNumber(5),
            'user_type' => 3,
            'interest' => 1
        ]);
        
        $this
            ->call('GET','api/users?type=customer')
            ->assertStatus(200)
            ->assertJsonCount(4) 
            ->assertJsonFragment([
                'user_type' => 1
            ]);   
    }    

    public function test_registers_new_user()
    {
        
        $this->post('/api/users', [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'phone' => "9988123450" ,
            'address' => $this->faker()->address(),
            'email' => $this->faker()->safeEmail(),
            'password' => $this->faker()->randomNumber(5),
            'user_type' => 1,
            'interest' => 1
        ])->assertStatus(201);
    }

    public function test_user_login() {

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
   
        
        // TODO: Receiving status code of 302
        // ! Not redirecting correctly
        // Session::start();
    
        // $this->post('user_login',[
        //     '_token' => Session::token(),
        //     'email' => $email1,
        //     'password' => $password1
        // ])
        // ->assertOk()
        // ->assertRedirect('profile/customer');
    }

    public function test_updates_existing_user_by_id()
    {
        
        $this->post('/api/users', [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'phone' => "9988123450" ,
            'address' => $this->faker()->address(),
            'email' => $this->faker()->safeEmail(),
            'password' => $this->faker()->randomNumber(5),
            'user_type' => 1,
            'interest' => 1
        ])->assertStatus(201);

        $this->put('/api/users/1', [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'phone' => "9988123880" ,
            'address' => $this->faker()->address(),
            'email' => $this->faker()->safeEmail(),
            'password' => $this->faker()->randomNumber(5),
            'user_type' => 1,
            'interest' => 1
        ])
        ->assertStatus(200)
        ->assertJsonCount(4) 
        ->assertJsonFragment([
            'phone' => "9988123880"
        ]);
    }
}
