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

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/master/{tabel}', 'HomeController@masterlist')->name('masterlist');
Route::get('/master/{tabel}/add', 'HomeController@masteradd')->name('masteradd');
Route::post('/master/{tabel}/save', 'HomeController@mastersave')->name('mastersave');
Route::get('/master/{tabel}/edit/{id}', 'HomeController@masteredit')->name('masteredit');
Route::post('/master/{tabel}/update', 'HomeController@masterupdate')->name('masterupdate');
Route::get('/master/{tabel}/delete/{id}', 'HomeController@masterdelete')->name('masterdelete');
Route::get('/{slug}', 'HomeController@page')->name('page');
