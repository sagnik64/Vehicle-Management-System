<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\RegistrationController;

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

Route::get('/register', [RegistrationController::class,'index']);
Route::post('/register', [RegistrationController::class,'register']);
Route::get('/order', function () {
    return view('order');
})->name('order');

Route::get('login', function () {
    if (session()->has('email')) {
        return redirect('profile/customer');
    }
    return view('login');
});



Route::get('logout', function () {
    if (session()->has('email')) {
        session()->pull('email');
    }
    return redirect('login');
});

Route::get('profile/customer', [CarController::class,'carsCustomer'])->name('profile/customer');

Route::view('visitor', 'profile/visitor');
// Route::view('profile/customer', 'profile/customer');
Route::view('profile/dealer', 'profile/dealer');
Route::view('profile/admin', 'profile/admin');

Route::post('user_login', [UserController::class, 'userLogin']);

Route::get('dashboard', [CarController::class,'carsDashboard']);
Route::post('getcar', [CarController::class,'carsDashboard']);


Route::view('mycart', 'profile.mycart');
