<?php

use Illuminate\Support\Facades\Route;


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

Route::get('/crypto/index', function () {
    return view('welcome');
});

Route::get('/crypto/markets', 'App\Http\Controllers\CryptoController@markets');
Route::get('/crypto/price', 'App\Http\Controllers\CryptoController@price');

