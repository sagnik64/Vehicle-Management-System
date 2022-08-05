<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BikeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/users',[UserController::class,'store']);

Route::post('bikes',[BikeController::class,'store']);
Route::get('allactivebikes',[BikeController::class,'getAllActiveBikes']);
Route::get('allinactivebikes',[BikeController::class,'getAllInactiveBikes']);
Route::get('bike/{bike_name}',[BikeController::class,'getbyBikeName']);
Route::get('bikes/{brand}',[BikeController::class,'getbyBrand']);

Route::get('bikebyprice/{v1}/{v2}',[BikeController::class,'getbyPrice']);
Route::get('/bikesbycc/{v1}/{v2}',[BikeController::class,'getbyCC']);
Route::get('/bikesbymilage/{v1}/{v2}',[BikeController::class,'getbyMileage']);

Route::get('/bikesbynameyear/{name}/{year}',[BikeController::class,'getbyNameYear']);

Route::post('cars',[CarController::class,'store']);
Route::get('cars',[CarController::class,'index']);
Route::get('cars/name/{car_name}',[CarController::class,'getByCarName']);
Route::get('cars/brand/{brand}',[CarController::class,'getByBrand']);
Route::get('cars/transmission/{transmission}',[CarController::class,'getByTransmission']);
Route::get('cars/fuel/{fuel_type}',[CarController::class,'getByFuelType']);
Route::get('cars/price/{price_start}/{price_end}',[CarController::class,'getBetweenPrice']);

