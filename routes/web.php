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

#Product And Material
Route::get('/products', 'ProductController@index')->name('products');
Route::get('/products/add', 'ProductController@create')->name('product.add');
Route::post('/product/store', 'ProductController@store')->name('product.store');
Route::get('/product/edit/{product_id}', 'ProductController@edit')->name('product.edit');
Route::post('/product/update', 'ProductController@update')->name('product.update');
Route::get('/product/status/{id}', 'ProductController@statusProduct')->name('product.status');

#Lorry CRUD
Route::get('/lorries', 'LorryController@index')->name('lorries');
Route::get('/lorries/add', 'LorryController@create')->name('lorry.add');
Route::post('/lorry/store', 'LorryController@store')->name('lorry.store');
Route::get('/lorry/edit/{lorry_id}', 'LorryController@edit')->name('lorry.edit');
Route::post('/lorry/update', 'LorryController@update')->name('lorry.update');
Route::get('/lorry/status/{id}', 'LorryController@statusLorry')->name('lorry.status');

#Deafult Set
#Sell Product Default
Route::get('/default/product/sell', 'DefaultController@defaultProductSell')->name('default.product.sell');
Route::get('/default/product/add', 'DefaultController@addViewDefaultProductSell')->name('default.product.sell.add');
Route::post('/default/product/store', 'DefaultController@addDefaultProductSell')->name('default.product.sell.store');
Route::get('/default/product/edit/{id}', 'DefaultController@editDefaultProductSell')->name('default.product.sell.edit');
Route::post('/default/product/update', 'DefaultController@updateDefaultProductSell')->name('default.product.sell.update');
Route::get('product/default/{product_id}', 'DefaultController@getDefault')->name('default.product.price');

#sell
Route::get('/sell', 'SellController@index')->name('sell');
Route::get('/sell/add', 'SellController@create')->name('sell.add');
Route::get('/sell/view/{sell_id}', 'SellController@show')->name('sell.show');
Route::post('/sell/store', 'SellController@store')->name('sell.store');

#Purchase
Route::get('/purchase', 'PurchaseController@index')->name('purchase');
Route::get('/purchase/add', 'PurchaseController@create')->name('purchase.add');
Route::get('/purchase/view/{purchase_id}', 'PurchaseController@show')->name('purchase.show');
Route::post('/purchase/store', 'PurchaseController@store')->name('purchase.store');

#Inventory
Route::get('/inventory', 'InventoryController@index')->name('inventory');
Route::get('/inventory/add', 'InventoryController@create')->name('inventory.add');
Route::post('/inventory/store', 'InventoryController@store')->name('inventory.store');
Route::get('/inventory/log', 'InventoryController@inventoryLog')->name('inventory.log');

#Payables
Route::get('/payables', 'FinancialController@getPayables')->name('payables.list');
Route::get('/payables/pay/{purchase_id}', 'FinancialController@payablesPayment')->name('payables.payment');
Route::post('/payables/pay', 'FinancialController@capturePayablesPayment')->name('payables.payment.capture');
