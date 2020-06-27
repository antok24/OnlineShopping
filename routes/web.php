<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('pesan/{id}','PesanController@addtocart');
Route::post('pesan/{id}','PesanController@pesansekarang');
Route::get('check-out','PesanController@check_out');
Route::delete('check-out/{id}','PesanController@deleteone');
Route::get('konfirmasi-check-out','PesanController@konfirmasi_check_out');

Route::get('profile','ProfileController@index');
Route::post('profile','ProfileController@update');

Route::get('history','HistoryController@index');
Route::get('history/{id}','HistoryController@detail');
