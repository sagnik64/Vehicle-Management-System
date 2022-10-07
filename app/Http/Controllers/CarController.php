<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Cart;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $car= Car::all();
        if (!$car->isEmpty()) {
            return response()->json([
                "success" => "true",
                "code" => 200,
                "message" => "Car data found",
                "data" => $car
            ], 200);
        }
        return response()->json([
            "status" => "fail",
            "code" => 400,
            "message" => "Car data not found"
        ], 400);
    }
    
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $car = Car::create($request->all());
        if ($car) {
            return response()->json([
                "success" => "true",
                "code" => 201,
                "message" => "Car data saved successfully",
                "data" => $car
            ], 201);
        }
        return response()->json([
            "success" => "false",
            "code" => 400,
            "message" => "Failed to save cars data"
        ], 400);
    }

    /**
     * Update the car data in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $car= Car::find($request->input('id'));
        $car->update($request->all());
        if ($car) {
            return response()->json([
                "success" => "true",
                "code" => 200,
                "message" => "Car data with ID = $car->id updated successfully",
                "data" => $car
            ], 200);
        }
        
        return response()->json([
            "success" => "false",
            "code" => 400,
            "message" => "Failed to update car data with ID = $car->id"
        ], 400);
    }

    /**
     * Remove the specified car from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $carFind = Car::find($request->input('id'));
        $carDelete = Car::destroy($request->input('id'));
        if ($carDelete) {
            return response()->json([
                "success" => "true",
                "code" => 200,
                "message" => "Car data with ID = $carFind->id deleted successfully",
                "data" => $carFind
            ], 200);
        }
        
        return response()->json([
            "success" => "false",
            "code" => 400,
            "message" => "Failed to delete car data with ID = $carFind->id"
        ], 400);
    }

    public function carsDashboard(Request $request)
    {
        $name = $request->name;
        $brand = $request->brand;
        $model = $request->model;
        $year = $request->year;
        $fuel = $request->fuel;
        $transmission = $request->transmission;
        $cars = Car::where('car_name', 'like', $name.'%')
        ->where('brand', 'like', $brand.'%')
        ->where('model', 'like', $model.'%')
        ->where('model_year', 'like', $year.'%')
        ->where('fuel_type', 'like', $fuel.'%')
        ->where('transmission', 'like', $transmission.'%')
        ->get();
        $data = compact('cars');
        return view('dashboard')->with($data);
    }
    
    public function carsCustomer(Request $request)
    {

        $userCartData = Cart::where('user_id', '=', session('uid'))->get();

        $userCartVID = [];
        for ($i=0; $i<count($userCartData); $i++) {
            if ($userCartData[$i]->status == 1) {
                $userCartVID[]= $userCartData[$i]->vehicle_type_id;
            }
        }
        $userCartVID = array_unique($userCartVID);
        $request->session()->put('userCartData', $userCartData);
        $request->session()->put('userCartDataCount', count($userCartVID));
        $request->session()->put('userCartVID', $userCartVID);

        $name = $request->name;
        $brand = $request->brand;
        $model = $request->model;
        $year = $request->year;
        $fuel = $request->fuel_type;
        $transmission = $request->transmission;
        $cars = Car::where('car_name', 'like', $name.'%')
        ->where('brand', 'like', $brand.'%')
        ->where('model', 'like', $model.'%')
        ->where('model_year', 'like', $year.'%')
        ->where('fuel_type', 'like', $fuel.'%')
        ->where('transmission', 'like', $transmission.'%')
        ->get();
        $data = compact('cars');
        return view('profile.customer')->with($data);
    }
}
