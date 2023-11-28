<?php

use App\Http\Controllers\API\WebsiteControllers\SettingController;
use App\Http\Controllers\API\WebsiteControllers\UserProfileController;
use App\Http\Controllers\API\WebsiteControllers\VendorController;
use App\Http\Controllers\API\WebsiteControllers\WishlistController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\WebsiteControllers\CarController;

//Route::get('/check', function (Request $request){
//    $tanant = \App\Models\Tanant::find(5);
//    if(date('Y-m-d', strtotime(Carbon::createFromDate($tanant->from_date)->subDays(1))) > date('Y-m-d', strtotime(Carbon::today())))
//    {
//        return 'can cancel';
//    }
//    else
//    {
//        return 'not cancel';
//    }
//});
//Search in Home Page
Route::get('/search-cars', [CarController::class, 'search_cars'])->name('vendor.search_cars');

//Route::get('/tenant', function(){
//    return \App\Models\Tanant::find(8);
//});

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

//Settings
Route::get('/settings/{col}', [SettingController::class, 'settings'])->name('website.settings');


//User Profile
Route::middleware(['auth:sanctum'])->group(function () {
    //Reserve Car
    Route::post('/reserve', [CarController::class, 'reserve_car'])->name('user.reserve_car');

    //user profile my reservations
    Route::get('/user-profile', [UserProfileController::class, 'profile'])->name('user.profile');
    Route::post('/user-profile', [UserProfileController::class, 'update_profile'])->name('user.update_profile');
    Route::post('/user-change-password', [UserProfileController::class, 'user_change_password'])->name('user.user_change_password');
    Route::get('/user-reservations', [UserProfileController::class, 'my_reservations'])->name('user.my_reservations');
    Route::get('/user-reservations-pagination', [UserProfileController::class, 'my_reservations_pagination'])->name('user.my_reservations_pagination');
    Route::get('/user-reserve/{id}', [UserProfileController::class, 'my_single_reserve'])->name('user.my_single_reserve');
    Route::post('/user-reserve-cancellation/{id}', [UserProfileController::class, 'reserve_cancellation'])->name('user.reserve_cancellation');

    //User Rate Vendor or Car
    Route::post('/rate', [UserProfileController::class, 'user_rate'])->name('user.user_rate');

    //Wishlists
    Route::post('/add-to-wishlist', [WishlistController::class, 'add_to_wishlist'])->name('user.add_to_wishlist');
    Route::get('/wishlists', [WishlistController::class, 'wishlists'])->name('user.wishlists');


});
