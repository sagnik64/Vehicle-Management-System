<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class UserControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_get_all_users_route() {
        $this->get('api/users')->assertStatus(200);
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

    
}
