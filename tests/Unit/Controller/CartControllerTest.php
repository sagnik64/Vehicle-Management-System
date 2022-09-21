<?php

namespace Tests\Unit\Controller;

use Tests\TestCase;
use App\Models\Cart;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CartControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_get_all_cart_route()
    {
        $this->post('api/cart', [
            'user_id' => 1,
            'vehicle_type_id' => 1,
            'vehicle_type' => 'car',
            'status' => 0
        ])->assertCreated();
        $this->post('api/cart', [
            'user_id' => 2,
            'vehicle_type_id' => 2,
            'vehicle_type' => 'car',
            'status' => 0
        ])->assertCreated();
        
        $this->get('api/cart')->assertStatus(200);
    }

    public function test_get_all_cart_count()
    {
        $this->post('api/cart', [
            'user_id' => 1,
            'vehicle_type_id' => 1,
            'vehicle_type' => 'car',
            'status' => 0
        ])->assertCreated();
        $this->post('api/cart', [
            'user_id' => 1,
            'vehicle_type_id' => 2,
            'vehicle_type' => 'car',
            'status' => 0
        ])->assertCreated();
        
        $response = $this->get('api/cart');
        $this->assertEquals(2, count($response->json()['data']));
    }

    public function test_get_cart_by_user_id()
    {
        $this->post('api/cart', [
            'user_id' => 1,
            'vehicle_type_id' => 3,
            'vehicle_type' => 'car',
            'status' => 0
        ])->assertCreated();
        $this->post('api/cart', [
            'user_id' => 2,
            'vehicle_type_id' => 4,
            'vehicle_type' => 'car',
            'status' => 0
        ])->assertCreated();
        
        $this->get('api/cart/1')->assertStatus(200)->assertJsonFragment(['vehicle_type_id' => 3]);
        $this->get('api/cart/2')->assertStatus(200)->assertJsonFragment(['vehicle_type_id' => 4]);
    }

    public function test_remove_from_cart()
    {
        $this->post('api/cart', [
            'user_id' => 1,
            'vehicle_type_id' => 1,
            'vehicle_type' => 'car',
            'status' => 0
        ])->assertCreated();
        
        $this->delete('api/cart/1')->assertStatus(200);
    }

    public function test_add_to_cart()
    {
        $this->post('api/cart', [
            'user_id' => 1,
            'vehicle_type_id' => 1,
            'vehicle_type' => 'car',
            'status' => 0
        ])->assertCreated();
        
        $this->get('api/cart/1')->assertStatus(200)->assertJsonFragment([
            'status' => 1
        ]);
    }
}
