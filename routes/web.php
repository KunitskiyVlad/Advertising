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

Route::get('/', 'AdvertisingController@index')->name('home');

Route::get('/edit', 'AdvertisingController@create')->name('advertising.create')->middleware('auth');
Route::post('/advertising', 'AdvertisingController@store')->name('advertising.store')->middleware('auth');
Route::delete('/delete/{advertising}', 'AdvertisingController@destroy')->name('advertising.delete')->middleware('auth');
Route::get('/edit/{advertising}', 'AdvertisingController@edit')->name('advertising.edit')->middleware('auth');
Route::patch('/edit/advertising/{advertising}','AdvertisingController@update')->name('advertising.update')->middleware('auth');
Route::get('/{advertising}','AdvertisingController@show');

Route::post('/login','Auth\LoginController@login')->name('login');
Route::post('/logout','Auth\LoginController@logout')->name('logout');
