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
Route::get('/fetchcounties', 'HomeController@fetchCounties');
Route::get('/fetchcities', 'HomeController@fetchCities');
Route::post('/addcity', 'HomeController@addcity');
Route::post('/deletecity', 'HomeController@destroyCity');
Route::get('/', function () {
    return view('welcome');
});
