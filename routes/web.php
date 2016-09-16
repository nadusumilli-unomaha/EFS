<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::resource('customers','CustomerController');
Route::resource('stocks','StockController');
Route::resource('investments','InvestmentController');
Route::get('/home', 'HomeController@index');

Route::any('.*', function () {
    return view('welcome');
});

Route::get('/customers/{any}', function ($any) {
    return view('welcome');
})->where('any', '.*');

Route::get('/{any}', function ($any) {
  return view('welcome');
})->where('any', '.*');
