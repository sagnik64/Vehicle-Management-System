<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BikeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('login', function () {
    if(session()->has('email')) {
        return redirect('profile');
    }
    return view('login');
});

Route::get('logout', function () {
    if(session()->has('email')) {
        session()->pull('email');
    }
    return redirect('login');
});

Route::view('visitor','profile/visitor');
Route::view('profile/customer','profile/customer');
Route::view('profile/dealer','profile/dealer');
Route::view('profile/admin','profile/admin');

Route::post('user_login',[UserController::class,'userLogin']);

Route::post('/bikes',[BikeController::class,'store']);
Route::get('allbikes',[BikeController::class,'getAllBikes']);
Route::get('/bike/{bike_name}',[BikeController::class,'getbyBikeName']);


Route::get('/bikesbynameyear/{name}/{year}',[BikeController::class,'getbyNameYear']);
