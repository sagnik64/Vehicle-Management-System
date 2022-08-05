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
    
    public function getAllActiveBikes(){
        return Bike::all()
        ->where('record_status','=', 1);
    }

    public function getAllInactiveBikes(){
        return Bike::all()
        ->where('record_status','=', 2);
    }
    
    public function getbyBikeId($id){
        return Bike::find($id);
      
    }
    
    public function getbyBikeName($req){
        return Bike::where('bike_name','like','%'.$req.'%')
        ->where('record_status','=', 1)
        ->get();
    }
    
    public function getbyBrand($req){
        return Bike::where('brand','like','%'.$req.'%')
        ->where('record_status','=', 1)
        ->get();
    }
    
    public function getbyPrice($val1,$val2){
        $minval = (int)$val1;
        $maxval = (int)$val2;
        return Bike::whereBetween('on_road_price',[$minval,$maxval])
        ->where('record_status','=', 1)
        ->get();
    }
    
    public function getbyCC($val1,$val2){
        $minCC = (int)$val1;
        $maxCC = (int)$val2;
        return Bike::whereBetween('engine_displacement_cc',[$minCC,$maxCC])
        ->where('record_status','=', 1)
        ->get();
    }
    
    public function getbyMileage($val1,$val2){
        $minMilage = (int)$val1;
        $maxMilage = (int)$val2;
        return Bike::whereBetween('kmpl_mileage',[$minMilage,$maxMilage])
        ->where('record_status','=', 1)
        ->get();
    }
    
    public function getbyNameYear($val1,$val2){
        $name = $val1;
        $year = (int)$val2;
        return Bike::where('bike_name','like','%'.$name.'%')
        ->where('model_year','=', $year)
        ->where('record_status','=', 1)
        ->get();
    }

    public function updatePrice($val1,$val2){
        $newPrice = (int)$val2;
        $data = Bike::find($val1)->update(['on_road_price'=>$newPrice]);
        if($data){
            return ["Result"=>"Price Updated Successfully."];
        }
        else{
            return ["Result"=>"Price Updation Failed."];
        }
    }
    
    public function updateDealer($val1,$val2){
        $newDealerId = (int)$val2;
        $data = Bike::find($val1)->update(['dealer_id'=>$newDealerId]);
        if($data){
            return ["Result"=>"Dealer Updated Successfully."];
        }
        else{
            return ["Result"=>"Dealer Updation Failed."];
        }
    }
    
    public function updateStatus($val1,$val2){
        $newStatusId = (int)$val2;
        $data = Bike::find($val1)->update(['record_status'=>$newStatusId]);
        if($data){
            return ["Result"=>"Status Updated Successfully."];
        }
        else{
            return ["Result"=>"Status Updation Failed."];
        }
    }
}
