<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function addUser(Request $req)
    {
       $user = User::create($req->all());
       if($user)
       {
        return response()->json([
            "success" => "true",
            "code"=> 201,
            "message"=>"Used Added Successfully.",
            "data"=>$user
        ],201);
    }
    else
    {
        return response()->json([
            "success" => "false",
            "code"=> 400,
            "message"=>"Used Addition Failed.",
        ],400);

       }
    }
}
