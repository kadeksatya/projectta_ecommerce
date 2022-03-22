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
Route::get('v1/product/list','API\ProductController@getListProduct')->middleware('jwt.verify');
Route::get('v1/product/{id}','API\ProductController@getDetailProduct')->middleware('jwt.verify');



