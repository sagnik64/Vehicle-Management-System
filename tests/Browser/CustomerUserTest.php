<?php

namespace Tests\Browser;

use App\Models\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CustomerUserTest extends DuskTestCase
{
    use RefreshDatabase,WithFaker;

    public function test_new_user_registers_with_new_email()
    {
        $this->browse(function (Browser $browser) {

            $firstName = $this->faker->firstName();
            $email = $firstName . $this->faker->randomNumber(5) . '@' . $this->faker->safeEmailDomain(); 
            $password = $this->faker()->password(5,8);
            $browser->visit('/register')
                    ->assertSee('User Registration')
                    ->type('first_name', $firstName)
                    ->type('last_name',$this->faker->lastName())
                    ->type('phone','98' . $this->faker->randomNumber(8,true))
                    ->type('email',$email)
                    ->type('address',$this->faker()->address())
                    ->type('password',$password)
                    ->type('confirm_password',$password)
                    ->press('Register')
                    ->assertPathIs('/register')
                    ->assertSee('user added successfully');
        });
    }

    public function test_failure_of_new_user_registers_with_existing_email()
    {   
        
        $this->browse(function (Browser $browser) {

        $firstName = $this->faker->firstName();

        // TODO: Fetch existing email from main MySQL database
        $email = 'Destini.Wisozk18@example.net';
        $password = $this->faker()->password(5,8);

            $firstName = $this->faker->firstName();
            
            $password = $this->faker()->password(5,8);
            $browser->visit('/register')
                    ->assertSee('User Registration')
                    ->type('first_name', $firstName)
                    ->type('last_name',$this->faker->lastName())
                    ->type('phone','98' . $this->faker->randomNumber(8,true))
                    ->type('email',$email)
                    ->type('address',$this->faker()->address())
                    ->type('password',$password)
                    ->type('confirm_password',$password)
                    ->press('Register')
                    ->assertPathIs('/register')
                    ->assertSee('The email has already been taken.');
        });
    }

    public function test_failure_of_new_user_registers_and_then_goes_to_login_page_and_types_wrong_email()
    {    
        $this->browse(function (Browser $browser) {

            $browser->visit('/logout');

            $firstName = $this->faker->firstName();
            $email = $firstName . $this->faker->randomNumber(5) . '@' . $this->faker->safeEmailDomain(); 
            $password = $this->faker()->password(5,8);
            $browser->visit('/register')
                    ->assertSee('User Registration')
                    ->type('first_name', $firstName)
                    ->type('last_name',$this->faker->lastName())
                    ->type('phone','98' . $this->faker->randomNumber(8,true))
                    ->type('email',$email)
                    ->type('address',$this->faker()->address())
                    ->type('password',$password)
                    ->type('confirm_password',$password)
                    ->press('Register')
                    ->assertPathIs('/register')
                    ->assertSee('user added successfully')
                    ->visit('login')
                    ->assertPathIs('/login')
                    ->type('email','abc' . $email)
                    ->type('password',$password)
                    ->press('Login')
                    ->assertPathIs('/user_login')
                    ->assertSee('Wrong email or password');
            });

            
    }

    public function test_failure_of_new_user_registers_and_then_goes_to_login_page_and_types_wrong_password()
    {    
        $this->browse(function (Browser $browser) {

            $browser->visit('/logout');

            $firstName = $this->faker->firstName();
            $email = $firstName . $this->faker->randomNumber(5) . '@' . $this->faker->safeEmailDomain(); 
            $password = $this->faker()->password(5,8);
            $browser->visit('/register')
                    ->assertSee('User Registration')
                    ->type('first_name', $firstName)
                    ->type('last_name',$this->faker->lastName())
                    ->type('phone','98' . $this->faker->randomNumber(8,true))
                    ->type('email',$email)
                    ->type('address',$this->faker()->address())
                    ->type('password',$password)
                    ->type('confirm_password',$password)
                    ->press('Register')
                    ->assertPathIs('/register')
                    ->assertSee('user added successfully')
                    ->visit('login')
                    ->assertPathIs('/login')
                    ->type('email', $email)
                    ->type('password',$password . '123')
                    ->press('Login')
                    ->assertPathIs('/user_login')
                    ->assertSee('Wrong email or password');
            });
    }

    public function test_new_user_registers_and_then_goes_to_login_page_and_logs_in_with_correct_email_and_password_and_then_redirects_to_customer_dashboard_and_then_logs_out () {
        $this->browse(function (Browser $browser) {

            $browser->visit('/logout');

            $firstName = $this->faker->firstName();
            $email = $firstName . $this->faker->randomNumber(5) . '@' . $this->faker->safeEmailDomain(); 
            $password = $this->faker()->password(5,8);
            $browser->visit('/register')
                    ->assertSee('User Registration')
                    ->type('first_name', $firstName)
                    ->type('last_name',$this->faker->lastName())
                    ->type('phone','98' . $this->faker->randomNumber(8,true))
                    ->type('email',$email)
                    ->type('address',$this->faker()->address())
                    ->type('password',$password)
                    ->type('confirm_password',$password)
                    ->press('Register')
                    ->assertPathIs('/register')
                    ->assertSee('user added successfully')
                    ->visit('login')
                    ->assertPathIs('/login')
                    ->type('email', $email)
                    ->type('password',$password)
                    ->press('Login')
                    ->assertPathIs('/profile/customer')
                    ->assertSee('Vehicle Management System')
                    ->clickLink('Logout')
                    ->assertPathIs('/login');
            });
    }
}
