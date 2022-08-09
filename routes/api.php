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

Route::get('/users',[UserController::class,'index']);
Route::post('/users',[UserController::class,'store']);
Route::put('/users',[UserController::class,'update']);
Route::delete('/users',[UserController::class,'destroy']);


Route::get('allbikes',[BikeController::class,'getAllBikes']);
Route::get('allactivebikes',[BikeController::class,'getAllActiveBikes']);
Route::get('allinactivebikes',[BikeController::class,'getAllInactiveBikes']);
Route::get('bikebyid/{id}',[BikeController::class,'getbyBikeId']);
Route::get('bike/{bike_name}',[BikeController::class,'getbyBikeName']);
Route::get('bikes/{brand}',[BikeController::class,'getbyBrand']);

Route::get('bikebypricerange/{v1}/{v2}',[BikeController::class,'getbyPrice']);
Route::get('bikesbyccrange/{v1}/{v2}',[BikeController::class,'getbyCC']);
Route::get('bikesbymilagerange/{v1}/{v2}',[BikeController::class,'getbyMileage']);
Route::get('bikesbynameyear/{name}/{year}',[BikeController::class,'getbyNameYear']);

Route::post('bikes',[BikeController::class,'store']);
Route::put('updatebikeprice/{bike_id}/{newprice}',[BikeController::class,'updatePrice']);
Route::put('updatebikedealer/{bike_id}/{newdealerid}',[BikeController::class,'updateDealer']);
Route::put('updatebikestatus/{bike_id}/{newdstatusid}',[BikeController::class,'updateStatus']);

Route::post('cars',[CarController::class,'store']);
Route::get('cars',[CarController::class,'index']);
Route::get('cars/name/{car_name}',[CarController::class,'getByCarName']);
Route::get('cars/brand/{brand}',[CarController::class,'getByBrand']);
Route::get('cars/transmission/{transmission}',[CarController::class,'getByTransmission']);
Route::get('cars/fuel/{fuel_type}',[CarController::class,'getByFuelType']);
Route::get('cars/price/{price_start}/{price_end}',[CarController::class,'getBetweenPrice']);