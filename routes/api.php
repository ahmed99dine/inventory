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
