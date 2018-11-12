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
#Unit Routes
Route::get('/units', 'MasterController@getUnits')->name('master.units');
Route::get('/unit/add', 'MasterController@addUnit')->name('master.unit.add');
Route::post('/unit/store', 'MasterController@storeUnit')->name('master.unit.store');
Route::get('/unit/edit/{id}', 'MasterController@editUnit')->name('master.unit.edit');
Route::post('/unit/update', 'MasterController@updateUnit')->name('master.unit.update');
Route::get('/unit/status/{id}', 'MasterController@statusUnit')->name('master.unit.status');

#Payment Mode Master
Route::get('/payment-mode', 'MasterController@getPaymentModes')->name('master.payment-mode');
Route::get('/payment-mode/add', 'MasterController@addPaymentMode')->name('master.payment-mode.add');
Route::post('/payment-mode/store', 'MasterController@storePaymentMode')->name('master.payment-mode.store');
Route::get('/payment-mode/edit/{id}', 'MasterController@editPaymentMode')->name('master.payment-mode.edit');
Route::post('/payment-mode/update', 'MasterController@updatePaymentMode')->name('master.payment-mode.update');
Route::get('/payment-mode/status/{id}', 'MasterController@statusPaymentMode')->name('master.payment-mode.status');

#Category Master
Route::get('/category', 'MasterController@getCategorys')->name('master.category');
Route::get('/category/add', 'MasterController@addCategory')->name('master.category.add');
Route::post('/category/store', 'MasterController@storeCategory')->name('master.category.store');
Route::get('/category/edit/{id}', 'MasterController@editCategory')->name('master.category.edit');
Route::post('/category/update', 'MasterController@updateCategory')->name('master.category.update');
Route::get('/category/status/{id}', 'MasterController@statusCategory')->name('master.category.status');

#Customer Route
Route::get('/customers', 'CustomerController@index')->name('customers');
Route::get('/customers/add', 'CustomerController@create')->name('customer.add');
Route::post('/customer/store', 'CustomerController@store')->name('customer.store');
Route::get('/customer/edit/{customer_id}', 'CustomerController@edit')->name('customer.edit');
Route::post('/customer/update', 'CustomerController@update')->name('customer.update');
Route::get('/customer/status/{id}', 'CustomerController@statusCustomer')->name('customer.status');

#Purchaser Route
Route::get('/purchasers', 'PurchaserController@index')->name('purchasers');
Route::get('/purchasers/add', 'PurchaserController@create')->name('purchaser.add');
Route::post('/purchaser/store', 'PurchaserController@store')->name('purchaser.store');
Route::get('/purchaser/edit/{purchaser_id}', 'PurchaserController@edit')->name('purchaser.edit');
Route::post('/purchaser/update', 'PurchaserController@update')->name('purchaser.update');
Route::get('/purchaser/status/{id}', 'PurchaserController@statusPurchaser')->name('purchaser.status');



