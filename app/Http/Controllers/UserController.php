<?php

namespace App\Http\Controllers;

use App\Jobs\SendLeadsToAdminMailJob;
use App\Models\User;
use Illuminate\Http\Request;
use App\Jobs\SendUserLogInMailJob;
use Illuminate\Support\Facades\Validator;
use App\Jobs\SendRegisteredCustomerMailJob;

class UserController extends Controller
{
    /**
     * Create and store new user in database
     * 
     * @Request $request request body
     * 
     * @return response
     */
    public function store(Request $request) {
        
        $user = User::create($request->all());
        
        if($user) {
            $userMatchedWithEmail = User::where('email','=',$request->email)->get();
            $userAdmin = User::where('user_type','=',3)->get();
            $userAdminFind = User::find($userAdmin[0]->id);
            $userCustomer = User::find($userMatchedWithEmail[0]->id);
            SendRegisteredCustomerMailJob::dispatch($userCustomer)->delay(now()->addSeconds(1));
            SendLeadsToAdminMailJob::dispatch($userAdminFind,$userCustomer)->delay(now()->addSeconds(1));
            return response()->json([
                "success" => "true",
                "code" => 201,
                "message" => "User data saved successfully",
                "data" => $user
            ],201);
        }
        return response()->json([
            "success" => "false",
            "code" => 400,
            "message" => "Failed to save user data"
            ],400);
    }

    public function userLogin(Request $request) {

        // return $request->input();
        $rules = array(
            "email"=>"required|email",
            "password"=>"required|min:4|max:20"
        );

        $isValid = Validator::make($request->all(),$rules);
        if($isValid->fails()) {
            return response()->json($isValid->errors(),401);
        }

        $data = $request->input();
        $request->session()->put('email',$data['email']);
        

        $user = User::where('email','=', session('email'))
                    ->where('password','=',$request->password)->get();

        
        //Authentication    
        if(count($user)===0) {
            return response()->json([
            "success" => "false",
            "code" => 400,
            "message" => "Wrong email or password"
            ],400);
        }
        
        $u = User::find($user[0]['id']);

        SendUserLogInMailJob::dispatch($u)->delay(now()->addSeconds(1));


        $user_first_name = $user[0]['first_name'];
        $user_type = $user[0]['user_type'];

        $request->session()->put('u_t', $user_type);
        $request->session()->put('name', $user_first_name);

        //Authorization
        if($user_type === 0) {
            return redirect('visitor');
        }
        else if($user_type === 1) {
            return redirect('profile/customer');
        }
        else if($user_type === 2) {
            return redirect('profile/dealer');
        }
        elseif($user_type === 3) {
            return redirect('profile/admin');
        }
        else {
            return redirect('visitor');
        }
    }
}
