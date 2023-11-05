<?php

use App\Http\Controllers\WebsiteControllers\UserProfileController;
use App\Http\Controllers\WebsiteControllers\VendorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebsiteControllers\CarController;

//Route::post('/check', function (Request $request){
//    $car = \App\Models\Car::find(1);
//    return  check_if_car_reserved_or_not($request, $car->id);
//});
//Search in Home Page
Route::get('/search-cars', [CarController::class, 'search_cars'])->name('vendor.search_cars');


//Cars in website
Route::get('/cars', [CarController::class, 'get_all_cars'])->name('vendor.get_all_cars');
Route::get('/cars-pagination', [CarController::class, 'get_all_cars_pagination'])->name('vendor.get_all_cars_pagination');
Route::get('/car/{car_id}', [CarController::class, 'get_single_car'])->name('vendor.get_single_car');
Route::get('/get-all-cars-brands', [CarController::class, 'get_all_cars_brands'])->name('vendor.get_all_cars_brands');
Route::get('/get-all-cars-brand-models', [CarController::class, 'get_all_cars_brand_models'])->name('vendor.get_all_brand_models');

//Check Availability
Route::get('/check-car-availability/{id}', [CarController::class, 'check_car_availability'])->name('vendor.check_car_availability');


//Vendors In Website
Route::get('/get-all-vendors', [VendorController::class, 'get_all_vendors'])->name('vendor.get_all_vendors');
Route::get('/get-all-featured-vendors', [VendorController::class, 'get_all_featured_vendors'])->name('vendor.get_all_featured_vendors');
Route::get('/get-single-featured-vendor/{id}', [VendorController::class, 'get_single_featured_vendor'])->name('vendor.get_single_featured_vendor');



//User Profile
Route::middleware(['auth:sanctum'])->group(function () {
    //Reserve Car
    Route::post('/reserve', [CarController::class, 'reserve_car'])->name('user.reserve_car');

    //user profile my reservations
    Route::get('/user-profile', [UserProfileController::class, 'profile'])->name('user.profile');
    Route::post('/user-change-password', [UserProfileController::class, 'user_change_password'])->name('user.user_change_password');
    Route::get('/user-reservations', [UserProfileController::class, 'my_reservations'])->name('user.my_reservations');
    Route::get('/user-reservations-pagination', [UserProfileController::class, 'my_reservations_pagination'])->name('user.my_reservations_pagination');
    Route::get('/user-reserve/{id}', [UserProfileController::class, 'my_single_reserve'])->name('user.my_single_reserve');

    //User Rate Vendor or Car
    Route::post('/rate', [UserProfileController::class, 'user_rate'])->name('user.user_rate');

});
