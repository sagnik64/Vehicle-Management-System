<?php

namespace Tests\Unit\Controller;

use Tests\TestCase;
use App\Models\Order;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    private function setUpMockDatabase() {
        Order::factory()->times(10)->create();
    }

    public function test_get_all_orders_route()
    {
        
        $this->setUpMockDatabase();
        
        $this->get('api/order')->assertStatus(200);
    }

    public function test_get_all_orders_json_count()
    {
        //preparation / prepare
        $this->setUpMockDatabase();
        
        //action / perform
        $reponse = $this->get('api/order')
        ->assertOk();
        
        //assertion / predict
        $reponse->assertJsonCount(4);
    }

    public function test_get_all_orders_json_structure()
    {
        $this->setUpMockDatabase();
        $this->get('api/order')
        ->assertOk()
        ->assertJsonStructure([
            'success',
            'code',
            'message',
            'data'
        ]);
    }

    public function test_get_all_orders_json_fragment()
    {
        
        $this->setUpMockDatabase();
        $this->get('api/order')
        ->assertOk()
        ->assertJsonFragment([
            "success" => "true",
            "code" => 200,
            "message" => "Order data found"
        ]);
    }

    public function test_get_order_by_id_route() {
        $this->setUpMockDatabase();
        $this->get('api/order/2')
        ->assertStatus(200);
    }

    public function test_get_order_by_id_json_count() {
        $this->setUpMockDatabase();
        $this->get('api/order/2')
        ->assertJsonCount(4);
    }

    public function test_get_order_by_id_json_structure() {
        $this->setUpMockDatabase();
        $this->get('api/order/2')
        ->assertJsonStructure([
            'success',
            'code',
            'message',
            'data'
        ]);
    }

    public function test_get_order_by_id_json_fragment() {
        $this->setUpMockDatabase();
        $this->get('api/order/2')
        ->assertJsonFragment([
            'success' => 'true',
            'code' => 200,
            'message' => 'Order data found where ID is equal to 2',
        ]);
    }

    public function test_get_order_by_id_json_exact() {
        $this->post('api/order',[
            'vehicle_type_id' => 1,
            'vehicle_type' => 'car',
            'customer_user_id' => 1,
            'dealer_user_id' => 1,
            'payment_mode' => 1,
            'transaction_reference' => 'ACBD1234',
            'added_on' => '2022-08-29',
            'status' => '1'
        ])->assertCreated();
        
        $reponse = $this->post('api/order',[
            'vehicle_type_id' => 1,
            'vehicle_type' => 'car',
            'customer_user_id' => 2,
            'dealer_user_id' => 2,
            'payment_mode' => 2,
            'transaction_reference' => 'ACBD1235',
            'added_on' => '2022-08-30',
            'status' => '1'
        ])->assertCreated();

        $responseData = $reponse->json()['data'];
        $responseData['status'] = (int)$responseData['status'];

        $this->get('api/order/2')
        ->assertExactJson([
            'success' => 'true',
            'code' => 200,
            'message' => 'Order data found where ID is equal to 2',
            'data' => $responseData
        ]);
    }

    public function test_stores_new_order_route() {
        $this->post('api/order',[
            'vehicle_type_id' => 1,
            'vehicle_type' => 'car',
            'customer_user_id' => 1,
            'dealer_user_id' => 1,
            'payment_mode' => 1,
            'transaction_reference' => 'ACBD1234',
            'added_on' => '2022-08-29',
            'status' => '1'
        ])->assertStatus(201);

        //vehicle_type_id missing
        $this->post('api/order',[
            'vehicle_type' => 'car',
            'customer_user_id' => 1,
            'dealer_user_id' => 1,
            'payment_mode' => 1,
            'transaction_reference' => 'ACBD1234',
            'added_on' => '2022-08-29',
            'status' => '1'
        ])->assertStatus(500);
    }

    public function test_stores_new_order_json_count() {
        $this->post('api/order',[
            'vehicle_type_id' => 1,
            'vehicle_type' => 'car',
            'customer_user_id' => 1,
            'dealer_user_id' => 1,
            'payment_mode' => 1,
            'transaction_reference' => 'ACBD1234',
            'added_on' => '2022-08-29',
            'status' => '1'
        ])->assertStatus(201)
        ->assertJsonCount(4);
    }

    public function test_stores_new_order_json_structure() {
        $this->post('api/order',[
            'vehicle_type_id' => 1,
            'vehicle_type' => 'car',
            'customer_user_id' => 1,
            'dealer_user_id' => 1,
            'payment_mode' => 1,
            'transaction_reference' => 'ACBD1234',
            'added_on' => '2022-08-29',
            'status' => '1'
        ])->assertStatus(201)
        ->assertJsonStructure([
            'success',
            'code',
            'message',
            'data'
        ]);
    }

    public function test_stores_new_order_json_fragment() {
        $this->post('api/order',[
            'vehicle_type_id' => 1,
            'vehicle_type' => 'car',
            'customer_user_id' => 1,
            'dealer_user_id' => 1,
            'payment_mode' => 1,
            'transaction_reference' => 'ACBD1234',
            'added_on' => '2022-08-29',
            'status' => '1'
        ])->assertStatus(201)
        ->assertJsonFragment([
            'success' => 'true',
            'code' => 201,
            'message' => 'Order data saved successfully'
        ]);
    }

    public function test_updates_existing_order_by_id_route() {
        $this->setUpMockDatabase();

        $this->put('api/order/1',[
            'vehicle_type_id' => 1,
            'vehicle_type' => 'car',
            'customer_user_id' => 1,
            'dealer_user_id' => 1,
            'payment_mode' => 1,
            'transaction_reference' => 'ACBD1234',
            'added_on' => '2022-08-29',
            'status' => '1'
        ])->assertStatus(200);

        $this->put('api/order/1000',[
            'vehicle_type_id' => 1,
            'vehicle_type' => 'car',
            'customer_user_id' => 1,
            'dealer_user_id' => 1,
            'payment_mode' => 1,
            'transaction_reference' => 'ACBD1234',
            'added_on' => '2022-08-29',
            'status' => '1'
        ])->assertStatus(500);

        $this->put('api/order/one',[
            'vehicle_type_id' => 1,
            'vehicle_type' => 'car',
            'customer_user_id' => 1,
            'dealer_user_id' => 1,
            'payment_mode' => 1,
            'transaction_reference' => 'ACBD1234',
            'added_on' => '2022-08-29',
            'status' => '1'
        ])->assertStatus(500);
    }

    public function test_updates_existing_order_by_id_json_count() {
        $this->setUpMockDatabase();

        $this->put('api/order/1',[
            'vehicle_type_id' => 1,
            'vehicle_type' => 'car',
            'customer_user_id' => 1,
            'dealer_user_id' => 1,
            'payment_mode' => 1,
            'transaction_reference' => 'ACBD1234',
            'added_on' => '2022-08-29',
            'status' => '1'
        ])->assertJsonCount(4);
    }

    public function test_updates_existing_order_by_id_json_structure() {
        $this->setUpMockDatabase();

        $this->put('api/order/1',[
            'vehicle_type_id' => 1,
            'vehicle_type' => 'car',
            'customer_user_id' => 1,
            'dealer_user_id' => 1,
            'payment_mode' => 1,
            'transaction_reference' => 'ACBD1234',
            'added_on' => '2022-08-29',
            'status' => '1'
        ])->assertJsonStructure([
            'success',
            'code',
            'message',
            'data'
        ]);
    }

    public function test_updates_existing_order_by_id_json_fragment() {
        $this->setUpMockDatabase();

        $this->put('api/order/1',[
            'vehicle_type_id' => 1,
            'vehicle_type' => 'car',
            'customer_user_id' => 1,
            'dealer_user_id' => 1,
            'payment_mode' => 1,
            'transaction_reference' => 'ACBD1234',
            'added_on' => '2022-08-29',
            'status' => '1'
        ])->assertJsonFragment([
            'success' => 'true',
            'code' => 200,
            'message' => 'Order data data with ID = 1 updated successfully'
        ]);
    }
    
}
