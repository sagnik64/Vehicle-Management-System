<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function store(Request $request) {
        $car = Inventory::create($request->all());
        if($car) {
            return response()->json([
                "success" => "true",
                "code" => 201,
                "message" => "Inventory data saved successfully",
                "data" => $car
            ],201);
        }
        return response()->json([
            "success" => "false",
            "code" => 400,
            "message" => "Failed to save Inventory data"
        ],400);
    }

    public function getInventorydata()
    {
        $data = Inventory::all();
        if(count($data)){
            return response()->json([
                "success" => "true",
                "code" => 201,
                "message" => "Inventory data are: ",
                "data" => $data
            ],201);
        }
        return response()->json([
            "success" => "false",
            "code" => 400,
            "message" => "No Data In Inventory"
        ],400);
    }

    public function getInventoryDataById($id){
        $data =  Inventory::find($id);
        if($data) {
            return response()->json([
                "success" => "true",
                "code" => 201,
                "message" => "Inventory data of having INVENTORY ID $id is: ",
                "data" => $data
            ],201);
        }
        return response()->json([
            "success" => "false",
            "code" => 400,
            "message" => "No Inventory data found of INVENTORY ID $id"
        ],400);
    }

    public function removeInventory(Request $request)
    {
        $inventoryFind = Inventory::find($request->input('id'));
        $inventoryDelete = Inventory::destroy($request->input('id'));
        if($inventoryDelete) {
            return response()->json([
                "success" => "true",
                "code" => 200,
                "message" => "Car data with ID = $inventoryFind->id deleted successfully",
                "data" => $inventoryFind
            ],200);  
        }
        
        return response()->json([
            "success" => "false",
            "code" => 400,
            "message" => "Failed to delete car data with ID = $inventoryFind->id"
        ],400);
    }

    public function updateInventoryStatus($id,$sts){
        
        $data = Inventory::find($id);
        $data->update(['status'=>$sts]);
        if ($data) {
            return response()->json([
                "success" => "true",
                "code" => 200,
                "message" => "User data with ID $id updated successfully",
                "data" => $data
            ], 200);
        }

        return response()->json([
            "success" => "false",
            "code" => 400,
            "message" => "Failed to update user data with ID $id"
        ], 400);
    }

    public function getInventoryStatus($id){
        $data =  Inventory::find($id);
        
        if($data){

            $status_code = $data->status;

            if($status_code == 0){
                $vehicle_status = 'Unlisted';
            }
            else if($status_code == 1){
                $vehicle_status = "Active";
            }
            else if($status_code == 2){
                $vehicle_status = "Inactive";
            }
            else{
                $vehicle_status = "Unknown";
            }

            return response()->json([
                "success" => "true",
                "code" => 201,
                "message" => "Inventory data of having INVENTORY ID $id is: ",
                "Status" => $vehicle_status
            ],201);
        }
        return response()->json([
            "success" => "false",
            "code" => 400,
            "message" => "No Inventory data found of INVENTORY ID $id",
            "Status" => "Unlisted"
        ],400);
    }

    public function getStatusWiseInventoryList($sts)
    {
        $data = Inventory::where('status',$sts)->get();

        if(count($data))
        {
            return response()->json([
                "success" => "true",
                "code" => 201,
                "message" => "Inventory data of having Status Code $sts is: ",
                "Status" => $data
            ],201);
        }
        return response()->json([
            "success" => "false",
            "code" => 400,
            "message" => "No Inventory data found having status code $sts"
        ],400);
    }
    
    public function getVehicleTypeWiseInventoryList($vt_cd)
    {
        $data = Inventory::where('vehicle_type',$vt_cd)->get();

        if(count($data))
        {
            return response()->json([
                "success" => "true",
                "code" => 201,
                "message" => "Inventory data of having Vehicle Type code $vt_cd is: ",
                "Status" => $data
            ],201);
        }
        return response()->json([
            "success" => "false",
            "code" => 400,
            "message" => "No Inventory data found having Vehicle Type code $vt_cd"
        ],400);
    }
    
    public function getInventoryListBySoldToId($buyer_id)
    {
        $data = Inventory::where('sold_to',$buyer_id)->get();

        if(count($data))
        {
            return response()->json([
                "success" => "true",
                "code" => 201,
                "message" => "Inventory data of having Buyer Id $buyer_id is: ",
                "Status" => $data
            ],201);
        }
        return response()->json([
            "success" => "false",
            "code" => 400,
            "message" => "Nothing is Sold to User having user-Id $buyer_id"
        ],400);
    }
}
