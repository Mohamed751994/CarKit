<?php

use App\Http\Controllers\AdminControllers\AuthController;
use App\Http\Controllers\AdminControllers\DashboardController;
use App\Http\Controllers\AdminControllers\UserController;
use App\Http\Controllers\AdminControllers\VendorController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;




/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/

Route::post('/login', [AuthController::class, 'login'])->name('admin.login');
Route::middleware(['auth', 'user-access:admin'])->namespace('App\Http\Controllers\AdminControllers')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');

    //Users Routes
    Route::resource('users', 'UserController');
    Route::put('/user/update/password/{user_id}', [UserController::class, 'update_password'])->name('users.update.password');
    Route::resource('vendors', 'VendorController');
    Route::post('/changeStatus', [VendorController::class, 'changeStatus'])->name('admin.changeStatus');




});
