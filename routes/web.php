<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



/*------------------------------------------
All User Interface Routes List
--------------------------------------------*/
Route::get('/', function () {
    return view('welcome');
});
//Auth::routes();


/*------------------------------------------
All Normal Users Routes List
--------------------------------------------*/
//Route::middleware(['auth', 'user-access:user'])->group(function () {
//    Route::get('/user', function () {
//        return 'user';
//    });
//});

