<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Supplier;
use App\Order;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/suppliers/store','SupplierController@store')->name('suppliers.store');
Route::get('/suppliers/{url_string}/orders', 'SupplierController@orders');
Route::put('/suppliers/{url_string}', 'SupplierController@update')->name('suppliers.update');
Route::get('/products/{url_string}/summary','ProductController@order_count');

Route::group(['middleware' => 'auth:api'], function(){
});

Route::group(['prefix' =>'orders'],function(){
  Route::post('/{id}/receive','OrderController@receiveOrder');
  Route::get('/index','OrderController@index');
  Route::get('/show/{id}','OrderController@show');
  Route::post('/store','OrderController@store');
  Route::delete('/destroy/{id}','OrderController@destroy');
  Route::put('/update/{id}','OrderItemController@update');
  Route::delete('/delete/{id}','OrderItemController@destroy');
});

Route::post('/orders/receive/{id}','OrderController@receiveOrder');
Route::get('/orders/test/{id}','OrderController@test');
Route::put('/invoice/update/{id}','InvoiceController@update');

Route::post('/suppliers/{id}/pay','PaymentController@supplier_payment');
Route::post('/sale/store','SaleController@sell');
