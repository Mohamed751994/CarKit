<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\VendorControllers\AuthController;
use App\Http\Controllers\VendorControllers\CarController;
use App\Http\Controllers\VendorControllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



/*------------------------------------------
--------------------------------------------
All Vendor Routes List
--------------------------------------------
--------------------------------------------*/



//****************User*******************************
Route::namespace('App\Http\Controllers\VendorControllers')->group(function(){

    //****************Not AUTH*******************************
    Route::post('/register', [AuthController::class, 'register'])->name('vendor.register');
    Route::post('/login', [AuthController::class, 'login'])->name('vendor.login');
    //****************END Not AUTH*******************************
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('vendor.logout');
        Route::post('/update-vendor-details', [DashboardController::class, 'update_vendor_details'])->name('vendor.update.details');
        Route::post('/create-new-car', [CarController::class, 'create_new_car'])->name('vendor.create_new_car');
    });

});
