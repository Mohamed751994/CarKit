<?php

use App\Http\Controllers\AdminControllers\AuthController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



/*------------------------------------------
All User Interface Routes List
--------------------------------------------*/
Route::get('/', [AuthController::class, 'login_page'])->name('admin.login_page');
Route::get('/migrate', function (){
    \Illuminate\Support\Facades\Artisan::call('migrate');
    return 'Migrated Successfully';
});

//Auth::routes();


/*------------------------------------------
All Normal Users Routes List
--------------------------------------------*/
Route::middleware(['auth', 'user-access:user'])->group(function () {
    Route::get('/user', function () {
        return 'user';
    });
});


