<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/signature', 'SignatureController@create')->name('signature');
Route::post('/signature', 'SignatureController@store')->name('store_signature');
Route::get('/signature/show', 'SignatureController@show')->name('show_signature');