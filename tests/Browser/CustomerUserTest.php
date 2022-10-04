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
            $password = $this->faker()->password(5, 8);
            $browser->visit('/register')
                    ->assertSee('User Registration')
                    ->type('first_name', $firstName)
                    ->type('last_name', $this->faker->lastName())
                    ->type('phone', '98' . $this->faker->randomNumber(8, true))
                    ->type('email', $email)
                    ->type('address', $this->faker()->address())
                    ->type('password', $password)
                    ->type('confirm_password', $password)
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
            $password = $this->faker()->password(5, 8);

            $firstName = $this->faker->firstName();
            
            $password = $this->faker()->password(5, 8);
            $browser->visit('/register')
                    ->assertSee('User Registration')
                    ->type('first_name', $firstName)
                    ->type('last_name', $this->faker->lastName())
                    ->type('phone', '98' . $this->faker->randomNumber(8, true))
                    ->type('email', $email)
                    ->type('address', $this->faker()->address())
                    ->type('password', $password)
                    ->type('confirm_password', $password)
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
            $password = $this->faker()->password(5, 8);
            $browser->visit('/register')
                    ->assertSee('User Registration')
                    ->type('first_name', $firstName)
                    ->type('last_name', $this->faker->lastName())
                    ->type('phone', '98' . $this->faker->randomNumber(8, true))
                    ->type('email', $email)
                    ->type('address', $this->faker()->address())
                    ->type('password', $password)
                    ->type('confirm_password', $password)
                    ->press('Register')
                    ->assertPathIs('/register')
                    ->assertSee('user added successfully')
                    ->visit('login')
                    ->assertPathIs('/login')
                    ->type('email', 'abc' . $email)
                    ->type('password', $password)
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
            $password = $this->faker()->password(5, 8);
            $browser->visit('/register')
                    ->assertSee('User Registration')
                    ->type('first_name', $firstName)
                    ->type('last_name', $this->faker->lastName())
                    ->type('phone', '98' . $this->faker->randomNumber(8, true))
                    ->type('email', $email)
                    ->type('address', $this->faker()->address())
                    ->type('password', $password)
                    ->type('confirm_password', $password)
                    ->press('Register')
                    ->assertPathIs('/register')
                    ->assertSee('user added successfully')
                    ->visit('login')
                    ->assertPathIs('/login')
                    ->type('email', $email)
                    ->type('password', $password . '123')
                    ->press('Login')
                    ->assertPathIs('/user_login')
                    ->assertSee('Wrong email or password');
        });
    }

    public function test_new_user_registers_and_then_goes_to_login_page_and_logs_in_with_correct_email_and_password_and_then_redirects_to_customer_dashboard_and_then_logs_out()
    {
        $this->browse(function (Browser $browser) {

            $browser->visit('/logout');

            $firstName = $this->faker->firstName();
            $email = $firstName . $this->faker->randomNumber(5) . '@' . $this->faker->safeEmailDomain();
            $password = $this->faker()->password(5, 8);
            $browser->visit('/register')
                    ->assertSee('User Registration')
                    ->type('first_name', $firstName)
                    ->type('last_name', $this->faker->lastName())
                    ->type('phone', '98' . $this->faker->randomNumber(8, true))
                    ->type('email', $email)
                    ->type('address', $this->faker()->address())
                    ->type('password', $password)
                    ->type('confirm_password', $password)
                    ->press('Register')
                    ->assertPathIs('/register')
                    ->assertSee('user added successfully')
                    ->visit('login')
                    ->assertPathIs('/login')
                    ->type('email', $email)
                    ->type('password', $password)
                    ->press('Login')
                    ->assertPathIs('/profile/customer')
                    ->assertSee('Vehicle Management System')
                    ->clickLink('Logout')
                    ->assertPathIs('/login');
        });
    }

    public function test_user_logs_in_and_then_adds_an_item_to_cart_and_then_logs_out()
    {
        $this->browse(function (Browser $browser) {

            $browser->visit('/logout');

            $email = 'Destini.Wisozk18@example.net';
            $password = '4336e';
            
            $browser->visit('login')
                    ->assertPathIs('/login')
                    ->type('email', $email)
                    ->type('password', $password)
                    ->press('Login')
                    ->assertPathIs('/profile/customer')
                    ->assertSee('Vehicle Management System')
                    ->press('Add to Cart')
                    ->assertPathIs('/api/cart')
                    ->assertSee('Item added successfully to the cart')
                    ->back()
                    ->assertPathIs('/profile/customer')
                    ->refresh()
                    ->assertPathIs('/profile/customer');

                $browser->assertSee('Remove from Cart')
                    ->press('Remove from Cart')
                    ->back()
                    ->assertPathIs('/profile/customer')
                    ->refresh()
                    ->visit('/logout');
        });
    }

    public function test_user_logs_in_and_then_adds_an_item_to_cart_and_removes_the_same_item_from_cart_and_then_logs_out()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/logout');

            $email = 'Destini.Wisozk18@example.net';
            $password = '4336e';
            
            $browser->visit('login')
                    ->assertPathIs('/login')
                    ->type('email', $email)
                    ->type('password', $password)
                    ->press('Login')
                    ->assertPathIs('/profile/customer')
                    ->assertSee('Vehicle Management System')
                    ->press('Add to Cart')
                    ->assertPathIs('/api/cart')
                    ->assertSee('Item added successfully to the cart')
                    ->back()
                    ->assertPathIs('/profile/customer')
                    ->refresh()
                    ->assertPathIs('/profile/customer')
                    ->assertSee('Remove from Cart')
                    ->press('Remove from Cart')
                    ->assertPathIs('/api/cart')
                    ->assertSee('removed from cart successfully')
                    ->back()
                    ->assertPathIs('/profile/customer')
                    ->refresh()
                    ->visit('/logout');
        });
    }

    public function test_user_logs_in_and_then_adds_multiple_items_to_cart_and_then_logs_out()
    {
        $this->browse(function (Browser $browser) {
        
            $browser->visit('/logout');

            $email = 'Destini.Wisozk18@example.net';
            $password = '4336e';
            
            $browser->visit('login')
                    ->assertPathIs('/login')
                    ->type('email', $email)
                    ->type('password', $password)
                    ->press('Login')
                    ->assertPathIs('/profile/customer')
                    ->assertSee('Vehicle Management System')
                    ->press('Add to Cart')
                    ->assertPathIs('/api/cart')
                    ->assertSee('Item added successfully to the cart')
                    ->back()
                    ->assertPathIs('/profile/customer')
                    ->refresh()
                    ->assertPathIs('/profile/customer')
                    ->screenshot('Test_08 Remove from Cart 1')
                    ->press('Add to Cart')
                    ->assertPathIs('/api/cart')
                    ->assertSee('Item added successfully to the cart')
                    ->back()
                    ->assertPathIs('/profile/customer')
                    ->refresh()
                    ->assertPathIs('/profile/customer')
                    ->screenshot('Test_08 Remove from Cart 2');

                    $browser
                    ->press('Remove from Cart')
                    ->back()
                    ->assertPathIs('/profile/customer')
                    ->refresh()
                    ->press('Remove from Cart')
                    ->back()
                    ->assertPathIs('/profile/customer')
                    ->refresh()
                    ->visit('/logout');
        });
    }

    public function test_user_logs_in_and_then_adds_multiple_items_to_cart_removes_some_items_from_cart_and_then_logs_out()
    {
        $this->browse(function (Browser $browser) {
        
            $browser->visit('/logout');
    
                $email = 'Destini.Wisozk18@example.net';
                $password = '4336e';
                
                $browser->visit('login')
                        ->assertPathIs('/login')
                        ->type('email', $email)
                        ->type('password', $password)
                        ->press('Login')
                        ->assertPathIs('/profile/customer')
                        ->assertSee('Vehicle Management System')
                        ->press('Add to Cart')
                        ->assertPathIs('/api/cart')
                        ->assertSee('Item added successfully to the cart')
                        ->back()
                        ->assertPathIs('/profile/customer')
                        ->refresh()
                        ->assertPathIs('/profile/customer')
                        ->press('Add to Cart')
                        ->assertPathIs('/api/cart')
                        ->assertSee('Item added successfully to the cart')
                        ->back()
                        ->assertPathIs('/profile/customer')
                        ->refresh()
                        ->assertPathIs('/profile/customer')
                        ->screenshot('Test_09 Added two items to cart');
    
                        $browser
                        ->press('Remove from Cart')
                        ->back()
                        ->assertPathIs('/profile/customer')
                        ->refresh()
                        ->visit('/logout')
                        ->assertPathIs('/login')
                        ->type('email', $email)
                        ->type('password', $password)
                        ->press('Login')
                        ->assertPathIs('/profile/customer')
                        ->screenshot('Test_09 Removed one of the items from cart')
                        ->press('Remove from Cart')
                        ->back()
                        ->assertPathIs('/profile/customer')
                        ->refresh()
                        ->visit('/logout');
        });
    }

    public function test_user_logs_in_and_then_places_an_order_of_an_item_after_adding_to_cart_and_logs_out()
    {
        $this->browse(function (Browser $browser) {
        
            $browser->visit('/logout');
    
                $email = 'Destini.Wisozk18@example.net';
                $password = '4336e';
                
                $browser->visit('login')
                        ->assertPathIs('/login')
                        ->type('email', $email)
                        ->type('password', $password)
                        ->press('Login')
                        ->assertPathIs('/profile/customer')
                        ->assertSee('Vehicle Management System')
                        ->press('Add to Cart')
                        ->assertPathIs('/api/cart')
                        ->assertSee('Item added successfully to the cart')
                        ->back()
                        ->assertPathIs('/profile/customer')
                        ->refresh()
                        ->assertSee('Remove from Cart')
                        ->screenshot('Test_10 See Remove from Cart')
                        ->press('Buy Now')
                        ->assertPathIs('/order')
                        ->type('dealer_user_id', 1)
                        ->press('Place Order')
                        ->assertSee('Order data saved successfully')
                        ->screenshot('Test_010 order placed successfully')
                        ->back()
                        ->assertPathIs('/order')
                        ->back()
                        ->assertPathIs('/profile/customer')
                        ->refresh()
                        ->visit('/logout')
                        ->assertPathIs('/login');
                        
                $browser->visit('/login')
                        ->type('email', $email)
                        ->type('password', $password)
                        ->press('Login')
                        ->assertPathIs('/profile/customer')
                        ->press('Remove from Cart')
                        ->back()
                        ->assertPathIs('/profile/customer')
                        ->refresh()
                        ->visit('/logout');
        });
    }

    public function test_user_logs_in_and_then_and_places_an_order_of_an_item_without_adding_to_cart_and_logs_out()
    {
        $this->browse(function (Browser $browser) {
        
            $browser->visit('/logout');
    
                $email = 'Destini.Wisozk18@example.net';
                $password = '4336e';
                
                $browser->visit('login')
                        ->assertPathIs('/login')
                        ->type('email', $email)
                        ->type('password', $password)
                        ->press('Login')
                        ->assertPathIs('/profile/customer')
                        ->assertSee('Vehicle Management System')
                        ->press('Buy Now')
                        ->assertPathIs('/order')
                        ->type('dealer_user_id', 1)
                        ->press('Place Order')
                        ->assertSee('Order data saved successfully')
                        ->screenshot('Test_010 order placed successfully')
                        ->back()
                        ->assertPathIs('/order')
                        ->back()
                        ->assertPathIs('/profile/customer')
                        ->refresh()
                        ->visit('/logout')
                        ->assertPathIs('/login');
        });
    }
}
