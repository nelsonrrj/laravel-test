<?php

use App\Exports\ApplicationExport;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

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

Route::prefix('phases')->middleware('auth:api')->group(function () {
    Route::get('/', 'App\Http\Controllers\PhaseController@index')->name('phases.index');
    Route::post('/', 'App\Http\Controllers\PhaseController@store')->name('phases.store');
    Route::put('/{id}', 'App\Http\Controllers\PhaseController@update')->name('phases.update');
    Route::delete('/{id}', 'App\Http\Controllers\PhaseController@destroy')->name('phases.delete');
});

Route::prefix('applications')->middleware('auth:api')->group(function () {
    Route::get('/', 'App\Http\Controllers\ApplicationController@index')->name('applications.index');
    Route::post('/', 'App\Http\Controllers\ApplicationController@store')->name('applications.store');
    Route::put('/{id}', 'App\Http\Controllers\ApplicationController@update')->name('applications.update');
    Route::delete('/{id}', 'App\Http\Controllers\ApplicationController@destroy')->name('applications.delete');
});

Route::get('/test', function() {
    $date = Date::now()->format('Y-m-d');
    return Excel::store(new ApplicationExport(), "aplicaciones $date.csv");
});