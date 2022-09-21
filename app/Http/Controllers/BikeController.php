<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bike;

class BikeController extends Controller
{

    /**
     * Adds Bike Into the Bike Table of the Database
     * @param Illuminate\Http\Request
     * Type Hinting of Request Class
     * @var $bike stores all the bike objects with their details
     * create function adds all the json data passed from postman to bike variable
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory in json format
     */
    public function store(Request $request)
    {
        
        $bike = Bike::create($request->all());

        if ($bike) {
            return response()->json([
                "success" => "true",
                "code" => 201,
                "message" => "Bike data saved successfully",
                "data" => $bike
            ], 201);
        }
        return response()->json([
            "success" => "false",
            "code" => 400,
            "message" => "Failed to save Bike data."
            ], 400);
    }

    /**
     * Shows all bike avialable in database
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllBikes()
    {
        return Bike::all();
    }

    /**
     * Shows All Bike having status code 1 i.e those are Active
     * @return \Illuminate\Database\Eloquent\Collection<mixed, \App\Models\Bike>
     */
    public function getAllActiveBikes()
    {
        return Bike::all()
        ->where('record_status', '=', 1);
    }

    /**
    * Shows All Bike having status code 2 i.e those are Inactive
    * @return \Illuminate\Database\Eloquent\Collection<mixed, \App\Models\Bike>
    */
    public function getAllInactiveBikes()
    {
        return Bike::all()
        ->where('record_status', '=', 2);
    }
    
    /**
    * Take bike id as argument
    * Finds respective id bike from the database
    * @param mixed $id Bike Id
    * @return mixed Collection type id specific Bike Detail
    */
    public function getbyBikeId($id)
    {
        return Bike::find($id);
    }
    
    /**
     * Takes bike name as argument
     * Searches all bike name having the keyword passed
     * Ensure Bike Status of active category by record_status 1
     * @param mixed $req Bikename
     * @return mixed Collection type Bike Detail
     */
    public function getbyBikeName($req)
    {
        return Bike::where('bike_name', 'like', '%'.$req.'%')
        ->where('record_status', '=', 1)
        ->get();
    }
    
    /**
     * Takes bike brand as argument
     * Searches all bike brand having the keyword passed
     * Ensure Bike Status of active category by record_status 1
     * @param mixed $req Brand Name
     * @return mixed Collection type Bike Detail
     */
    
    public function getbyBrand($req)
    {
        return Bike::where('brand', 'like', '%'.$req.'%')
        ->where('record_status', '=', 1)
        ->get();
    }
    
    /**
     * Takes two bike price argument for minimum value and maximum value
     * Searches all bikes having the on road price range passed using whereBetween function
     * Ensure Bike Status of active category by record_status 1
     * @param val1 $val1 minimum Price container
     * @param val2 $val2 maximum Price container
     * @var minval holds type casted val1 value
     * @var maxval holds type casted val2 value
     * @return mixed Collection type Bike Detail
     */
    public function getbyPrice($val1, $val2)
    {
        $minval = (int)$val1;
        $maxval = (int)$val2;
        return Bike::whereBetween('on_road_price', [$minval,$maxval])
        ->where('record_status', '=', 1)
        ->get();
    }

    /**
     * Takes two bike CC argument for minimum value and maximum value
     * Searches all bikes having engine displacement CC range passed using whereBetween function
     * Ensure Bike Status of active category by record_status 1
     * @param val1 $val1 minimum engine_displacement_cc container
     * @param val2 $val2 maximum engine_displacement_cc container
     * @var minCC holds type casted val1 value
     * @var maxCC holds type casted val2 value
     * @return mixed Collection type Bike Detail
     *
     */
    public function getbyCC($val1, $val2)
    {
        $minCC = (int)$val1;
        $maxCC = (int)$val2;
        return Bike::whereBetween('engine_displacement_cc', [$minCC,$maxCC])
        ->where('record_status', '=', 1)
        ->get();
    }
    
    /**
     * Takes two bike Mileage argument for minimum value and maximum value
     * Searches all bikes having the kmpl_mileage range passed using whereBetween function
     * Ensure Bike Status of active category by record_status 1
     * @param val1 $val1 minimum kmpl_mileage
     * @param val2 $val2 maximum kmpl_mileage
     * @var minMileage holds type casted val1 value
     * @var maxMileage holds type casted val2 value
     * @return mixed Collection type Bike Detail
     */
    public function getbyMileage($val1, $val2)
    {
        $minMilage = (int)$val1;
        $maxMilage = (int)$val2;
        return Bike::whereBetween('kmpl_mileage', [$minMilage,$maxMilage])
        ->where('record_status', '=', 1)
        ->get();
    }
    
    /**
     * Filter the Serach result on the basis of Bike name and Year
     * Two Arguments are passed for receiving bikename and year respectively
     * Uses Where Function to getall bike having keyword $name
     * Filter Bikes according to the year passed
     * Filters Bike which is active by record_Status 1
     * @param val1 $val1 — Bike_Name container
     * @param val2 $val2 — Year container
     * @var minMileage holds val1 value
     * @var maxMileage holds type casted val2 value
     * @return mixed — Collection type Bike Detail
     */
    public function getbyNameYear($val1, $val2)
    {
        $name = $val1;
        $year = (int)$val2;
        return Bike::where('bike_name', 'like', '%'.$name.'%')
        ->where('model_year', '=', $year)
        ->where('record_status', '=', 1)
        ->get();
    }

    /**
     * Updates the Price of the bike on the basis of bike id
     * Takes two argument for receiving bike is and New Price for bike
     * Uses find function to get the bike on the basis of the bike id
     * Uses Update function to update the current Price
     * @param mixed $val1 — BIke_Id
     * @param mixed $val2 — New Price
     * @var newPrice holds type casted val2 value
     * @return mixed — String array type Acknowledgement
     */
    public function updatePrice($val1, $val2)
    {
        $newPrice = (int)$val2;
        $data = Bike::find($val1)->update(['on_road_price'=>$newPrice]);
        if ($data) {
            return ["Result"=>"Price Updated Successfully."];
        } else {
            return ["Result"=>"Price Updation Failed."];
        }
    }
    
    /**
     * Updates the Dealer of the bike on the basis of bike id
     * Takes two argument for receiving bike is and New dealer_id for bike
     * Uses find function to get the bike on the basis of the bike id
     * Uses Update function to update the current dealer
     * @param val1 — Bike_Id
     * @param val2 — Dealer Id Container
     * @var newDealerId holds type casted val2 value
     * @return mixed — String array type Acknowledgement
     */
    public function updateDealer($val1, $val2)
    {
        $newDealerId = (int)$val2;
        $data = Bike::find($val1)->update(['dealer_id'=>$newDealerId]);
        if ($data) {
            return ["Result"=>"Dealer Updated Successfully."];
        } else {
            return ["Result"=>"Dealer Updation Failed."];
        }
    }
    
    /**
     * Updates the Status of the bike on the basis of bike id
     * Takes two argument for receiving bike is and New Status Code for bike
     * Uses find function to get the bike on the basis of the bike id
     * Uses Update function to update the current Status
     * @param val1 — Bike_id
     * @param val2 — record_status container
     * @var newStatusId holds type casted val2 value
     * @return mixed — String array type Acknowledgement
     */
    public function updateStatus($val1, $val2)
    {
        $newStatusId = (int)$val2;
        $data = Bike::find($val1)->update(['record_status'=>$newStatusId]);
        if ($data) {
            return ["Result"=>"Status Updated Successfully."];
        } else {
            return ["Result"=>"Status Updation Failed."];
        }
    }
}
