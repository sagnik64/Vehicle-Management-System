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
Route::get('/users/{id}',[UserController::class,'getUserById']);
Route::post('/users',[UserController::class,'store']);
Route::put('/users/{id}',[UserController::class,'update']);
Route::delete('/users',[UserController::class,'destroy']);
Route::get('/users/interested',[UserController::class,'getCustomers']);


Route::post('bikes',[BikeController::class,'store']);
Route::get('allbikes',[BikeController::class,'getAllBikes']);
Route::get('allactivebikes',[BikeController::class,'getAllActiveBikes']);
Route::get('allinactivebikes',[BikeController::class,'getAllInactiveBikes']);
Route::get('bikebyid/{id}',[BikeController::class,'getbyBikeId']);
Route::get('bike/{bike_name}',[BikeController::class,'getbyBikeName']);
Route::get('bikes/{brand}',[BikeController::class,'getbyBrand']);

Route::get('bikebyprice/{v1}/{v2}',[BikeController::class,'getbyPrice']);
Route::get('/bikesbycc/{v1}/{v2}',[BikeController::class,'getbyCC']);
Route::get('/bikesbymilage/{v1}/{v2}',[BikeController::class,'getbyMileage']);
Route::get('/bikesbynameyear/{name}/{year}',[BikeController::class,'getbyNameYear']);

Route::put('/updatebikeprice/{bike_id}/{newprice}',[BikeController::class,'updatePrice']);
Route::put('/updatebikedealer/{bike_id}/{newdealerid}',[BikeController::class,'updateDealer']);
Route::put('/updatebikestatus/{bike_id}/{newdstatusid}',[BikeController::class,'updateStatus']);

Route::post('cars',[CarController::class,'store']);
Route::get('cars',[CarController::class,'index']);
Route::put('cars',[CarController::class,'update']);
Route::delete('cars',[CarController::class,'destroy']);
Route::get('cars/name/{car_name}',[CarController::class,'getByCarName']);
Route::get('cars/brand/{brand}',[CarController::class,'getByBrand']);
Route::get('cars/transmission/{transmission}',[CarController::class,'getByTransmission']);
Route::get('cars/fuel/{fuel_type}',[CarController::class,'getByFuelType']);
Route::get('cars/price/{price_start}/{price_end}',[CarController::class,'getBetweenPrice']);