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
Route::get('/crypto/exchanges', 'App\Http\Controllers\CryptoController@exchanges');
Route::get('/crypto/exchange', 'App\Http\Controllers\CryptoController@exchange');
Route::get('/crypto/volumechart', 'App\Http\Controllers\CryptoController@volumeChart');
Route::get('/crypto/statusupdates', 'App\Http\Controllers\CryptoController@statusUpdates');
Route::get('/crypto/events', 'App\Http\Controllers\CryptoController@events');
Route::get('/crypto/globaldata', 'App\Http\Controllers\CryptoController@globalData');
Route::get('/crypto/finance', 'App\Http\Controllers\CryptoController@finance');
Route::get('/crypto/financeproducts', 'App\Http\Controllers\CryptoController@financeProducts');

