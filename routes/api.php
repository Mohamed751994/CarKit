<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebsiteControllers\CarController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::get('/cars', [CarController::class, 'get_all_cars'])->name('vendor.get_all_cars');
Route::get('/car/{car_id}', [CarController::class, 'get_single_car'])->name('vendor.get_single_car');
Route::post('/reserve', [CarController::class, 'reserve_car'])->name('user.reserve_car');


Route::get('/get-all-cars-brands', [CarController::class, 'get_all_cars_brands'])->name('vendor.get_all_cars_brands');
Route::get('/get-all-cars-brand-models', [CarController::class, 'get_all_cars_brand_models'])->name('vendor.get_all_brand_models');

// Route::post('/reserve', function () {
//     return '123';
// });
