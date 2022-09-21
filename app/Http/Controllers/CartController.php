<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Create new cart and store in database
     *
     * @Request $request request body
     *
     * @return response
     */
    public function addToCart(Request $request)
    {
        // return $request->all();
        if ($request->status == 1) {
            $cartFind = Cart::where('user_id', '=', $request->user_id)
                        ->where('vehicle_type_id', '=', $request->vehicle_type_id)->get()->first();
            $cartDelete = Cart::destroy($cartFind->id);
            if ($cartDelete) {
                return response()->json([
                    "success" => "true",
                    "code" => 200,
                    "message" => "Cart data with ID = $cartFind->id removed from cart successfully",
                    "data" => $cartFind
                ], 200);
            }
        }
        $request['status'] = 1;
        $cart = Cart::create($request->all());
        if ($cart) {
            return response()->json([
                "success" => "true",
                "code" => 201,
                "message" => "Item added successfully to the cart",
                "data" => $cart
            ], 201);
        }
        return response()->json([
            "success" => "false",
            "code" => 400,
            "message" => "Failed to save cart data"
        ], 400);
    }

    /**
     * Display a listing of all cart data.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = Cart::all();
        if (!$cart ->isEmpty()) {
            return response()->json([
                "success" => "true",
                "code" => 200,
                "message" => "Cart data found",
                "data" => $cart
            ], 200);
        }
        return response()->json([
            "status" => "true",
            "code" => 200,
            "message" => "No records found"
        ], 200);
    }

    /**
     * Display listing of cart data of a particular user.
     *
     * @param $userId user_id attribute of the carts table
     *
     * @return \Illuminate\Http\Response
     */
    public function getUserCart($userId)
    {
        $cart = Cart::where('user_id', '=', $userId)->get();
        if (count($cart)) {
            return response()->json([
                "success" => "true",
                "code" => 200,
                "message" => "Cart data found of user ID = $userId",
                "data" => $cart
            ], 200);
        }
        return response()->json([
            "status" => "true",
            "code" => 200,
            "message" => "No records found"
        ], 200);
    }

    /**
     * Remove the specified cart data from storage.
     *
     * @param  $ID id attribute of the carts table
     *
     * @return \Illuminate\Http\Response
     */
    public function removeFromCart($ID)
    {
        $cart = Cart::find($ID);
        $cartDelete = Cart::destroy($ID);
        if ($cartDelete) {
            return response()->json([
                "success" => "true",
                "code" => 200,
                "message" => "Cart data with ID = $ID removed from cart successfully",
                "data" => $cart
            ], 200);
        }
        return response()->json([
            "success" => "false",
            "code" => 400,
            "message" => "Failed to delete cart data with ID = $ID"
        ], 400);
    }
}
