<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bike;

class BikeController extends Controller
{
    public function store(Request $request) {
        
        $bike = Bike::create($request->all());

        if($bike) {
            return response()->json([
                "success" => "true",
                "code" => 201,
                "message" => "Bike data saved successfully",
                "data" => $bike
            ],201);
        }
        return response()->json([
            "success" => "false",
            "code" => 400,
            "message" => "Failed to save Bike data."
            ],400);
    }

    public function getAllBikes(){
        return Bike::all();
    }
    
    public function getbyBikeName($req){
        return Bike::where('bike_name','like','%'.$req.'%')->get();
    }
    
    public function getbyBrand($req){
    return Bike::where('brand','like','%'.$req.'%')->get();
    }
}
