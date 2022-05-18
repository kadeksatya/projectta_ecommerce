<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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



Route::post('v1/login','API\AuthController@login');
Route::get('v1/logout','API\AuthController@logout');

Route::post('v1/register','API\AuthController@register');

Route::get('v1/profile','API\AuthController@profile')->middleware('jwt.verify');
Route::get('v1/category/list','API\CategoryController@getListCategory')->middleware('jwt.verify');
Route::get('v1/category/{id}','API\CategoryController@getProductWithCategory')->middleware('jwt.verify');

// Product
Route::get('v1/product/{id}','API\ProductController@getDetailProduct')->middleware('jwt.verify');
// List Product
Route::get('v1/product/list/feature','API\ProductController@getIsFeaturedProduct')->middleware('jwt.verify');
Route::get('v1/product/list/recommendation','API\ProductController@getRecommendationProduct')->middleware('jwt.verify');
Route::get('v1/product/list/popular','API\ProductController@getPopularProduct')->middleware('jwt.verify');
Route::get('v1/list/product','API\ProductController@getList')->middleware('jwt.verify');



// Address
Route::get('v1/address/list/{customer_id}','API\AddressController@index')->middleware('jwt.verify');
Route::post('v1/address/store','API\AddressController@store')->middleware('jwt.verify');
Route::put('v1/address/{id}/update','API\AddressController@update')->middleware('jwt.verify');
Route::delete('v1/address/{id}/delete','API\AddressController@destroy')->middleware('jwt.verify');

// Stock
Route::post('v1/stock','API\StockController@getListStock');

// BANK
Route::get('v1/bank','API\BankController@getListBank');

// Onkir
Route::get('v1/onkir','API\TransportController@getListTransport');


// Transaction

Route::post('v1/transaction/store','API\TransactionController@store')->middleware('jwt.verify');
Route::get('v1/transaction/{id}/detail','API\TransactionController@detail')->middleware('jwt.verify');
Route::get('v1/transaction/{id}/list','API\TransactionController@list')->middleware('jwt.verify');

// Cart
Route::get('v1/list/{customer_id}','API\CartController@index')->middleware('jwt.verify');
Route::post('v1/addcart','API\CartController@store')->middleware('jwt.verify');
Route::put('v1/update/{id}','API\CartController@update')->middleware('jwt.verify');
Route::delete('v1/delete/{id}','API\CartController@destroy')->middleware('jwt.verify');


Route::post('v1/payment','API\PaymentController@upload')->middleware('jwt.verify');
