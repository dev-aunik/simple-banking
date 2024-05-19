<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['middleware' => 'guest'], function () {
    Route::get('users', [App\Http\Controllers\AuthController::class, 'register'])->name('register');
    Route::post('users', [App\Http\Controllers\AuthController::class, 'registerPost'])->name('register.post');
    Route::get('login', [App\Http\Controllers\AuthController::class, 'login'])->name('login');
    Route::post('login', [App\Http\Controllers\AuthController::class, 'loginPost'])->name('login.post');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('deposit', [App\Http\Controllers\HomeController::class, 'deposit'])->name('deposit');
    Route::post('deposit/{user_id}', [App\Http\Controllers\HomeController::class, 'depositPost'])->name('deposit.post');
    Route::get('withdrawal', [App\Http\Controllers\HomeController::class, 'withdrawal'])->name('withdrawal');
    Route::post('withdrawal/{user_id}', [App\Http\Controllers\HomeController::class, 'withdrawalPost'])->name('withdrawal.post');
    Route::post('logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
});
