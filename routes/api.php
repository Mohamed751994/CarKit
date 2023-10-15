<?php

use App\Http\Controllers\WebsiteControllers\VendorController;
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

//Cars in website
Route::get('/cars', [CarController::class, 'get_all_cars'])->name('vendor.get_all_cars');
Route::get('/car/{car_id}', [CarController::class, 'get_single_car'])->name('vendor.get_single_car');
Route::get('/get-all-cars-brands', [CarController::class, 'get_all_cars_brands'])->name('vendor.get_all_cars_brands');
Route::get('/get-all-cars-brand-models', [CarController::class, 'get_all_cars_brand_models'])->name('vendor.get_all_brand_models');

//Reserve Car
Route::post('/reserve', [CarController::class, 'reserve_car'])->name('user.reserve_car');

//Vendors In Website
Route::get('/get-all-vendors', [VendorController::class, 'get_all_vendors'])->name('vendor.get_all_vendors');

// Route::post('/reserve', function () {
//     return '123';
// });
