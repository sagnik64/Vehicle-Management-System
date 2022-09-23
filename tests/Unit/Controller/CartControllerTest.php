<?php

namespace Tests\Unit\Controller;

use Tests\TestCase;
use App\Models\Cart;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CartControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    private function setUpMockDatabase() {
        $this->post('api/cart', [
            'user_id' => 1,
            'vehicle_type_id' => 1,
            'vehicle_type' => 'car',
            'status' => 0
        ]);
        $this->post('api/cart', [
            'user_id' => 2,
            'vehicle_type_id' => 2,
            'vehicle_type' => 'car',
            'status' => 0
        ]);
    }

    public function test_get_all_cart_route()
    {
        //Preparation
        $this->setUpMockDatabase();

        //Action
        $response = $this->get('api/cart');
        
        //Assertion
        $response->assertStatus(200);
    }

    public function test_get_all_cart_count()
    {
        //Preparation
        $this->setUpMockDatabase();
        
        //Action
        $response = $this->get('api/cart');

        //Assertion
        $this->assertEquals(2, count($response->json()['data']));
    }

    public function test_get_cart_by_user_id()
    {
        //Preparation
        $this->setUpMockDatabase();
        
        //Action
        $response1 = $this->get('api/cart/1');
        $response2 = $this->get('api/cart/20');

        //Assertion
        $response1->assertStatus(200)->assertJsonFragment(['vehicle_type_id' => 1]);
        $response2->assertStatus(404)->assertJsonFragment(['message' => 'No records found']);
    }

    public function test_remove_from_cart()
    {
        //Preparation
        $this->setUpMockDatabase();
        
        //Action
        $response = $this->delete('api/cart/1');

        //Assertion
        $response->assertStatus(200);
    }
}
