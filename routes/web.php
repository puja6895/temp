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

// Home Dashbaord
Route::get('/home', 'HomeController@index')->name('home');

// Setting Routes
Route::get('/setting', 'SettingController@index')->name('setting');
Route::post('/setting/update', 'SettingController@updateSettings')->name('setting.update');

// Master Routes
Route::get('/units', 'MasterController@getUnits')->name('master.units');
Route::get('/unit/add', 'MasterController@addUnit')->name('master.unit.add');
Route::post('/unit/store', 'MasterController@storeUnit')->name('master.unit.store');
Route::get('/unit/edit/{id}', 'MasterController@editUnit')->name('master.unit.edit');
Route::post('/unit/update', 'MasterController@updateUnit')->name('master.unit.update');
Route::get('/unit/status/{id}', 'MasterController@statusUnit')->name('master.unit.status');

