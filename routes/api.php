<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\BikeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\InvoiceController;

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

Route::get('/users', [UserController::class,'index']);
Route::get('/users/{id}', [UserController::class,'getUserById']);
Route::post('/users', [UserController::class,'store']);
Route::put('/users/{id}', [UserController::class,'update']);
Route::delete('/users', [UserController::class,'destroy']);
Route::get('/users/interested', [UserController::class,'getCustomers']);
Route::patch('/user/update-user-type', [UserController::class,'updateUserType']);

Route::get('allbikes', [BikeController::class,'getAllBikes']);
Route::get('allactivebikes', [BikeController::class,'getAllActiveBikes']);
Route::get('allinactivebikes', [BikeController::class,'getAllInactiveBikes']);
Route::get('bikebyid/{id}', [BikeController::class,'getbyBikeId']);
Route::get('bike/{bike_name}', [BikeController::class,'getbyBikeName']);
Route::get('bikes/{brand}', [BikeController::class,'getbyBrand']);

Route::get('bikebypricerange/{v1}/{v2}', [BikeController::class,'getbyPrice']);
Route::get('bikesbyccrange/{v1}/{v2}', [BikeController::class,'getbyCC']);
Route::get('bikesbymilagerange/{v1}/{v2}', [BikeController::class,'getbyMileage']);
Route::get('bikesbynameyear/{name}/{year}', [BikeController::class,'getbyNameYear']);

Route::post('bikes', [BikeController::class,'store']);
Route::put('updatebikeprice/{bike_id}/{newprice}', [BikeController::class,'updatePrice']);
Route::put('updatebikedealer/{bike_id}/{newdealerid}', [BikeController::class,'updateDealer']);
Route::put('updatebikestatus/{bike_id}/{newdstatusid}', [BikeController::class,'updateStatus']);

Route::post('cars', [CarController::class,'store']);
Route::get('cars', [CarController::class,'index']);
Route::put('cars', [CarController::class,'update']);
Route::delete('cars', [CarController::class,'destroy']);

Route::get('search-car', [CarController::class,'searchCar']);

Route::get('cars/name/{car_name}', [CarController::class,'getByCarName']);
Route::get('cars/brand/{brand}', [CarController::class,'getByBrand']);
Route::get('cars/transmission/{transmission}', [CarController::class,'getByTransmission']);
Route::get('cars/fuel/{fuel_type}', [CarController::class,'getByFuelType']);
Route::get('cars/price/{price_start}/{price_end}', [CarController::class,'getBetweenPrice']);

Route::post('/add-inventory', [InventoryController::class,'store']);
Route::get('/inventory-data', [InventoryController::class,'getInventorydata']);
Route::get('/inventory-data/{id}', [InventoryController::class,'getInventoryDataById']);
Route::delete('/remove-inventory-data', [InventoryController::class,'removeInventory']);
Route::patch('/update-inventory-status/{id}/{sts}', [InventoryController::class,'updateInventoryStatus']);
Route::get('/inventory-status/{id}', [InventoryController::class,'getInventoryStatus']);
Route::get('/inventories-by-status-code/{id}', [InventoryController::class,'getStatusWiseInventoryList']);
Route::get('/inventories-by-vehicle-type-code/{id}', [InventoryController::class,'getVehicleTypeWiseInventoryList']);
Route::get('/inventories-by-sold-to-id/{id}', [InventoryController::class,'getInventoryListBySoldToId']);

Route::post('/add-invoice', [InvoiceController::class,'store']);
Route::get('/invoice', [InvoiceController::class,'getInvoice']);
Route::get('/invoice/{id}', [InvoiceController::class,'getInvoiceDataById']);
Route::get('/invoice/order/{id}', [InvoiceController::class,'getInvoiceByOrderId']);
Route::get('/invoice/vehicle/{id}', [InvoiceController::class,'getInvoiceByVehicleId']);
Route::get('/invoice/dealer/{id}', [InvoiceController::class,'getInvoicesOfDealerId']);
Route::get('/invoice/transaction/{id}', [InvoiceController::class,'getInvoiceByTransactionId']);
Route::get('/invoice/price/{minval}/{maxval}', [InvoiceController::class,'getInvoiceBetweenPrice']);
Route::delete('/remove-invoice', [InvoiceController::class,'removeInvoice']);

Route::get('vehicle/status/{id}', [VehicleController::class,'getStatus']);
Route::post('vehicle', [VehicleController::class,'store']);
Route::put('vehicle/{id}', [VehicleController::class,'update']);
Route::delete('vehicle/{id}', [VehicleController::class,'destroy']);

Route::get('order', [OrderController::class,'index']);
Route::get('order/{id}', [OrderController::class,'getOrder']);
Route::post('order', [OrderController::class,'store'])->name('order');
Route::put('order/{id}', [OrderController::class,'update']);

Route::post('cart', [CartController::class,'addToCart'])->name('cart.store');
Route::get('cart', [CartController::class,'index']);
Route::get('cart/{userId}', [CartController::class,'getUserCart']);
Route::delete('cart/{Id}', [CartController::class,'removeFromCart']);
