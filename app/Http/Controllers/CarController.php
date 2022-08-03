<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $car = Car::create($request->all());
        if($car) {
            return response()->json([
                "success" => "true",
                "code" => 201,
                "message" => "Car data saved successfully",
                "data" => $car
            ],201);
        }
        return response()->json([
            "success" => "false",
            "code" => 400,
            "message" => "Failed to save cars data"
        ],400);
    }
}
