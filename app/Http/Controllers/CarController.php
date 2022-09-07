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
     * Display a listing of the resource by car name.
     * @param $carName car_name attribute in cars table
     * @return \Illuminate\Http\Response
     */
    public function getByCarName($carName) {
        $car = Car::where('car_name', 'like', $carName."%")
        ->where('record_status', '=', 1)
        ->select('car_name', 'id', 'price_rs', 'brand', 'model', 'fuel_type', 'transmission')
        ->orderBy('car_name')
        ->get();

        if(count($car)) {
            return response()->json([
                "success" => "true",
                "code" => 200,
                "message" => "Found car data with car name matching with $carName",
                "data" => $car
            ],200); 
        }

        return response()->json([
            "success" => "false",
            "code" => 404,
            "message" => "No records found of car data with car name matching with $carName"
        ],404);        
    }

    /**
     * Display a listing of the resource by brand name.
     * @param $brand brand attribute in cars table
     * @return \Illuminate\Http\Response
     */
    public function getByBrand($brand) {
        $car = Car::where('brand', 'like', $brand."%")
        ->where('record_status', '=', 1)
        ->select('brand', 'id', 'car_name', 'price_rs','model', 'fuel_type', 'transmission')
        ->orderBy('brand')
        ->get();

        if(count($car)) {
            return response()->json([
                "success" => "true",
                "code" => 200,
                "message" => "Found car data with brand name matching with $brand",
                "data" => $car
            ],200); 
        }

        return response()->json([
            "success" => "false",
            "code" => 404,
            "message" => "No records found of car data with brand name matching with $brand"
        ],404);        
    }

    /**
     * Display a listing of the resource by transmission type.
     * @param $tr transmission attribute in cars table
     * @return \Illuminate\Http\Response
     */
    public function getByTransmission($tr) {
        $car = Car::where('transmission', 'like', $tr."%")
        ->where('record_status', '=', 1)
        ->select('transmission', 'id', 'car_name', 'price_rs', 'brand', 'model', 'fuel_type')
        ->orderBy('car_name')
        ->get();

        if(count($car)) {
            return response()->json([
                "success" => "true",
                "code" => 200,
                "message" => "Found car data with transmission type matching with $tr",
                "data" => $car
            ],200); 
        }

        return response()->json([
            "success" => "false",
            "code" => 404,
            "message" => "No records found of car data with transmission type matching with $tr"
        ],404);        
    }

    /**
     * Display a listing of the resource by fuel type.
     * @param $ft fuel_type attribute in cars table
     * @return \Illuminate\Http\Response
     */
    public function getByFuelType($ft) {
        $car = Car::where('fuel_type', 'like', $ft."%")
        ->where('record_status', '=', 1)
        ->select('fuel_type', 'id', 'car_name', 'price_rs', 'brand', 'model', 'transmission')
        ->orderBy('car_name')
        ->get();

        if(count($car)) {
            return response()->json([
                "success" => "true",
                "code" => 200,
                "message" => "Found car data with fuel type matching with $ft",
                "data" => $car
            ],200); 
        }

        return response()->json([
            "success" => "false",
            "code" => 404,
            "message" => "No records found of car data with fuel type matching with $ft"
        ],404);        
    }
    
    /**
     * Display a listing of the resource by between price_start and price_end.
     * @param $price_start starting price_rs, $price_end ending price_rs 
     * 
     * @return \Illuminate\Http\Response
     */
    public function getBetweenPrice($price_start,$price_end) {
        $car = Car::where('price_rs', '>=', $price_start)
        ->where('price_rs', '<=', $price_end)
        ->where('record_status', '=', 1)
        ->select('fuel_type', 'id', 'car_name', 'price_rs', 'brand', 'model', 'transmission')
        ->orderBy('car_name')
        ->get();

        if(count($car)) {
            return response()->json([
                "success" => "true",
                "code" => 200,
                "message" => "Found car data",
                "data" => $car
            ],200); 
        }

        return response()->json([
            "success" => "false",
            "code" => 404,
            "message" => "No records found"
        ],404);        
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
        if($car) {
            return response()->json([
                "success" => "true",
                "code" => 200,
                "message" => "Car data with ID = $car->id updated successfully",
                "data" => $car
            ],200);  
        }
        
        return response()->json([
            "success" => "false",
            "code" => 400,
            "message" => "Failed to update car data with ID = $car->id"
        ],400);
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
        if($carDelete) {
            return response()->json([
                "success" => "true",
                "code" => 200,
                "message" => "Car data with ID = $carFind->id deleted successfully",
                "data" => $carFind
            ],200);  
        }
        
        return response()->json([
            "success" => "false",
            "code" => 400,
            "message" => "Failed to delete car data with ID = $carFind->id"
        ],400);
        
    }

    public function carsDashboard(Request $request)
    {
        $name = $request->name;
        $brand = $request->brand;
        $model = $request->model;
        $year = $request->year;
        $fuel = $request->fuel;
        $transmission = $request->transmission;
        $cars = Car::where('car_name','like',$name.'%')
        ->where('brand','like',$brand.'%')
        ->where('model','like',$model.'%')
        ->where('model_year','like',$year.'%')
        ->where('fuel_type','like',$fuel.'%')
        ->where('transmission','like',$transmission.'%')
        ->get();
        $data = compact('cars');
        return view('dashboard')->with($data);
    }
    
    public function carsCustomer(Request $request)
    {
        $name = $request->name;
        $brand = $request->brand;
        $model = $request->model;
        $year = $request->year;
        $fuel = $request->fuel;
        $transmission = $request->transmission;
        $cars = Car::where('car_name','like',$name.'%')
        ->where('brand','like',$brand.'%')
        ->where('model','like',$model.'%')
        ->where('model_year','like',$year.'%')
        ->where('fuel_type','like',$fuel.'%')
        ->where('transmission','like',$transmission.'%')
        ->get();
        $data = compact('cars');
        return view('profile.customer')->with($data);
    }
}
