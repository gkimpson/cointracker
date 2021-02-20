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

Route::get('/crypto/markets', 'App\Http\Controllers\CryptoController@marketList');
Route::get('/crypto/price', 'App\Http\Controllers\CryptoController@price');
Route::get('/crypto/tokenprice', 'App\Http\Controllers\CryptoController@tokenPrice');
Route::get('/crypto/currencies', 'App\Http\Controllers\CryptoController@supportedCurrencies');
Route::get('/crypto/coins', 'App\Http\Controllers\CryptoController@coinsList');
Route::get('/crypto/coin', 'App\Http\Controllers\CryptoController@coin');
Route::get('/crypto/tickers', 'App\Http\Controllers\CryptoController@tickers');
Route::get('/crypto/history', 'App\Http\Controllers\CryptoController@history');
Route::get('/crypto/marketchart', 'App\Http\Controllers\CryptoController@marketChart');
Route::get('/crypto/marketchartrange', 'App\Http\Controllers\CryptoController@marketChartRange');
Route::get('/crypto/marketchartrangebeta', 'App\Http\Controllers\CryptoController@marketChartRangeBeta');

