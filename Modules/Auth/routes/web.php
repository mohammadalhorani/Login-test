<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\App\Http\Controllers\AuthController;

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

// Route::group([], function () {
//     Route::resource('auth', AuthController::class)->names('auth');
// });

use Modules\Auth\App\Http\Controllers\RegistereController;

use Modules\Auth\App\Http\Controllers\LoginController;


Route::middleware('guest')->group(function () {
    Route::get('register', [RegistereController::class, 'register'])
        ->name('register');

    Route::post('register', [RegistereController::class, 'store']);

    Route::get('login', [LoginController::class, 'login'])
        ->name('login');

    Route::post('login', [LoginController::class, 'store']);


});
Route::middleware('auth')->group(function () {


    Route::post('logout', [LoginController::class, 'logout'])->name('logout');


});

