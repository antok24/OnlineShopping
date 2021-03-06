<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('pesan/{id}','PesanController@addtocart');
Route::post('pesan/{id}','PesanController@pesansekarang');
Route::post('update/{id}','PesanController@updatepesansekarang');
Route::get('check-out','PesanController@check_out');
Route::get('check-out/{id}','PesanController@edit');
Route::delete('check-out/{id}','PesanController@deleteone');
Route::get('konfirmasi-check-out','PesanController@konfirmasi_check_out');
Route::get('bayar/{id}','PesanController@bayar');

Route::get('profile','ProfileController@index');
Route::post('profile','ProfileController@update');

Route::get('history','HistoryController@index');
Route::get('history/{id}','HistoryController@detail');
