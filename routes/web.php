<?php

use Illuminate\Support\Facades\Route;
use App\Order;
use App\Supplier;
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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/products/new', 'ProductController@create')->name('products.create');
Route::get('/products', 'ProductController@index')->name('products.index');
Route::get('/products/{url_string}', 'ProductController@show')->name('products.show');
Route::delete('/products/{url_string}', 'ProductController@destroy')->name('products.destroy');
Route::put('/products/{url_string}', 'ProductController@update')->name('products.update');
Route::get('/products/{url_string}/edit', 'ProductController@edit')->name('products.edit');

Route::post('/products', 'ProductController@store')->name('products.store');

// Route::resource('products','ProductController');
//Route::resource('suppliers','SupplierController');
Route::get('/suppliers/create', 'SupplierController@create')->name('suppliers.create');
Route::get('/suppliers', 'SupplierController@index')->name('suppliers.index');
Route::get('/suppliers/{url_string}', 'SupplierController@show')->name('suppliers.show');
Route::delete('/suppliers/{url_string}', 'SupplierController@destroy')->name('suppliers.destroy');
Route::get('/suppliers/{url_string}/edit', 'SupplierController@edit')->name('suppliers.edit');
Route::put('/suppliers/{url_string}/', 'SupplierController@update')->name('suppliers.update');
Route::post('/suppliers/store','SupplierController@store')->name('suppliers.store');
// Route::get('/suppliers/{url_string}/orders', 'SupplierController@orders')->name('suppliers.orders');

Route::get('/orders/{id}/orderitems','OrderController@items')->name('orders.items');
//Route::get('/orders','OrderController@index')->name('orders.index');
