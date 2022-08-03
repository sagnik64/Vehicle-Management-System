<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $car= Car::all();
        if(!$car->isEmpty()) {
            return response()->json([
                "success" => "true",
                "code" => 200,
                "message" => "Car data found",
                "data" => $car
            ],200);
        }
        return response()->json([
            "status" => "fail",
            "code" => 400,
            "message" => "Car data not found"
        ],400);
    }
    
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
