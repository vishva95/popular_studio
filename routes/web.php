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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::name('home.')->group(function () {
    Route::get('/change-multiple-status', 'HomeController@changeMultipleStatus')->name('change-multiple-status');
    Route::get('/delete-multiple', 'HomeController@deleteMultiple')->name('delete-multiple');
  });
  
//user
Route::resource('user','UserController');
