<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('auth')->group(function () {
    Route::post('/login', 'App\Http\Controllers\AuthController@login')->name('auth.login');
});

Route::prefix('users')->group(function () {
    Route::post('/', 'App\Http\Controllers\UserController@store')->name('users.store');
    Route::put('/{id}', 'App\Http\Controllers\UserController@update')->middleware('auth:api')->name('users.update');
});
