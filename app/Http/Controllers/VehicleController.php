<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function getStatus($ID) {
        $vehicle = Vehicle::find($ID);
        $status = 'unknown';
        if($status == 0) {
            $status = 'unlisted';
        }
        else if($status == 1) {
            $status = 'send for approval';
        }
        else if($status == 2) {
            $status = 'approved';
        }
        else if($status == 3) {
            $status = 'declined/send back to dealer for changes';
        }

        if ($vehicle) {
            return response()->json([
                "success" => "true",
                "code" => 200,
                "message" => "Vehicle listing status is $status",
                "data" => $vehicle
            ], 200);
        }
        return response()->json([
            "status" => "fail",
            "code" => 404,
            "message" => "Vehicle listing status data not found"
        ], 404);
    }

    public function store(Request $request) {
        $vehicle = Vehicle::create($request->all());
        if ($vehicle) {
            return response()->json([
                "success" => "true",
                "code" => 201,
                "message" => "Vehicle listing status data saved successfully",
                "data" => $vehicle
            ], 201);
        }
        return response()->json([
            "success" => "false",
            "code" => 400,
            "message" => "Failed to save vehicle listing status data"
        ], 400);
    }

    public function update(Request $request, $ID) {
        $vehicle = Vehicle::find($ID);
        $vehicle->update($request->all());
        if ($vehicle) {
            return response()->json([
                "success" => "true",
                "code" => 200,
                "message" => "Vehicle listing status data data with ID = $ID updated successfully",
                "data" => $vehicle
            ], 200);
        }

        return response()->json([
            "success" => "false",
            "code" => 400,
            "message" => "Failed to update vehicle listing status data with ID = $ID"
        ], 400);
    }

    public function destroy($ID) {
        $vehicleFind = Vehicle::find($ID);
        $vehicleDelete = Vehicle::destroy($ID);
        if ($vehicleDelete) {
            return response()->json([
                "success" => "true",
                "code" => 200,
                "message" => "Vehicle listing status data with ID = $ID deleted successfully",
                "data" => $vehicleFind
            ], 200);
        }

        return response()->json([
            "success" => "false",
            "code" => 400,
            "message" => "Failed to delete vehicle listing status data with ID = $ID"
        ], 400);
    }
}
