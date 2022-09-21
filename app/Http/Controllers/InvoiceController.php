<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function store(Request $request)
    {
        $car = Invoice::create($request->all());
        if ($car) {
            return response()->json([
                "success" => "true",
                "code" => 201,
                "message" => "Invoice data saved successfully",
                "data" => $car
            ], 201);
        }
        return response()->json([
            "success" => "false",
            "code" => 400,
            "message" => "Failed to save Invoice data"
        ], 400);
    }

    public function getInvoice()
    {
        $data = Invoice::all();
        if (count($data)) {
            return response()->json([
                "success" => "true",
                "code" => 201,
                "Total Available Invoices :"=> count($data),
                "message" => "All Invoices are: ",
                "data" => $data
            ], 201);
        }
        return response()->json([
            "success" => "false",
            "code" => 400,
            "message" => "No Invoice Available"
        ], 400);
    }

    public function getInvoiceDataById($id)
    {
        $data =  Invoice::find($id);
        if ($data) {
            return response()->json([
                "success" => "true",
                "code" => 201,
                "message" => "Invoice of Invoice ID $id is: ",
                "data" => $data
            ], 201);
        }
        return response()->json([
            "success" => "false",
            "code" => 400,
            "message" => "No Invoice found of Invoice ID $id"
        ], 400);
    }

    public function removeInvoice(Request $request)
    {
        $userFind = Invoice::find($request->input('id'));
        $userDelete = Invoice::destroy($request->input('id'));
        if ($userDelete) {
            return response()->json([
                "success" => "true",
                "code" => 200,
                "message" => "User data with ID = $userFind->id deleted successfully",
            ], 200);
        }
        return response()->json([
            "success" => "false",
            "code" => 400,
            "message" => "No Invoice found of Order ID $userFind->id"
        ], 400);
    }
    
    public function getInvoiceByOrderId($odr_id)
    {
        $data =  Invoice::where("order_id", $odr_id)->get();
        if ($data) {
            return response()->json([
                "success" => "true",
                "code" => 201,
                "message" => "Invoice of Order ID $odr_id is: ",
                "data" => $data
            ], 201);
        }
        return response()->json([
            "success" => "false",
            "code" => 400,
            "message" => "No Invoice found of Order ID $odr_id"
        ], 400);
    }
    
    public function getInvoiceByVehicleId($vid)
    {
        $data =  Invoice::where("vehicle_id", $vid)->get();
        if ($data) {
            return response()->json([
                "success" => "true",
                "code" => 201,
                "message" => "Invoice of Vehicle ID $vid is: ",
                "data" => $data
            ], 201);
        }
        return response()->json([
            "success" => "false",
            "code" => 400,
            "message" => "No Invoice found of Vehicle ID $vid"
        ], 400);
    }
    
    public function getInvoiceByTransactionId($txn_id)
    {
        $data =  Invoice::where("transaction_id", $txn_id)->get();
        if ($data) {
            return response()->json([
                "success" => "true",
                "code" => 201,
                "message" => "Invoice of Transaction ID $txn_id is: ",
                "data" => $data
            ], 201);
        }
        return response()->json([
            "success" => "false",
            "code" => 400,
            "message" => "No Invoice found of Transaction ID $txn_id"
        ], 400);
    }

    public function getInvoiceBetweenPrice($price_start, $price_end)
    {
        $data = Invoice::whereBetween('price', [$price_start,$price_end])
        ->get();

        if (count($data)) {
            return response()->json([
                "success" => "true",
                "code" => 200,
                "message" => "Found Invoice data",
                "data" => $data
            ], 200);
        }

        return response()->json([
            "success" => "false",
            "code" => 404,
            "message" => "No Invoice found"
        ], 404);
    }
}
