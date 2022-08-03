<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function userLogin(Request $req){
        $data = $req->input();
        $req->session()->put('user',$data['username']);
        return "Login successfull.";
    }
}
