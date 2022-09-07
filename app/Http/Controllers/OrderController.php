<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display all listings of the order.
     * @param $request Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $order = Order::all();
        if(!$order ->isEmpty()) {
            return response()->json([
                "success" => "true",
                "code" => 200,
                "message" => "Order data found",
                "data" => $order 
            ],200);
        }
        return response()->json([
            "status" => "true",
            "code" => 200,
            "message" => "No records found"
        ],200);
    }

    /**
     * Display a listing of the order by ID.
     * @param $ID id attribute of the orders table
     * @return \Illuminate\Http\Response
     */
    public function getOrder($ID) {
        $order = Order::find($ID);
        if ($order) {
            return response()->json([
                "success" => "true",
                "code" => 200,
                "message" => "Order data found where ID is equal to $ID",
                "data" => $order
            ], 200);
        }
        return response()->json([
            "status" => "fail",
            "code" => 404,
            "message" => "Order data not found"
        ], 404);
    }

    /**
     * Create and store new order in database
     * 
     * @Request $request request body
     * 
     * @return response
     */
    public function store(Request $request) {
        // return $request->all();
        $order = Order::create($request->all());
        if($order) {
            return response()->json([
                "success" => "true",
                "code" => 201,
                "message" => "Order data saved successfully",
                "data" => $order
            ],201);
        }
        return response()->json([
            "success" => "false",
            "code" => 400,
            "message" => "Failed to save order data"
        ],400);
    }

    /**
     * Update the order data in storage by ID.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param $ID id attribute of the orders table
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $ID) {
        $order = Order::find($ID);
        $order->update($request->all());
        if ($order) {
            return response()->json([
                "success" => "true",
                "code" => 200,
                "message" => "Order data data with ID = $ID updated successfully",
                "data" => $order
            ], 200);
        }

        return response()->json([
            "success" => "false",
            "code" => 400,
            "message" => "Failed to update order data with ID = $ID"
        ], 400);
    }
}
