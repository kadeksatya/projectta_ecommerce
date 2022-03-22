<?php

use Illuminate\Support\Facades\Route;

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




Auth::routes(['register' => false]);







Route::get('/home', 'HomeController@index')->name('home');
Route::get('/login', 'Auth\LoginController@login')->name('loginpro');

Route::middleware(['auth'])->group(function () {
    Route::resource('admin', 'Admin\UserController');
    Route::resource('category', 'Admin\CategoryController');
    // Route::resource('variant', 'Admin\VariantController');
    Route::resource('ongkir', 'Admin\OngkirController');
    Route::resource('bank', 'Admin\BankController');
    Route::resource('unit', 'Admin\UnitController');
    Route::resource('product', 'Admin\ProductController');
    Route::resource('customer', 'Admin\CustomerController');
    Route::resource('sales', 'Admin\SalesController');
    Route::resource('stock', 'Admin\StockController');
    Route::get('/stock/{id}/detail', 'Admin\StockController@show');
    Route::get('/stock/{id}/create', 'Admin\StockController@create');
    Route::resource('/user', 'Admin\UserController');

});

