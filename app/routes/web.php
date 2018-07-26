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
Route::get('/category/{id}', 'CategoryController@index')->name("category");
Route::get('/store', 'StoreController@index');
Route::get('/product/{id}', 'ProductDetailController@index')->name("product_detail");
Route::get('/cart/add/{id}', 'ShoppingCartController@add')->name("shopping_cart_add");
Route::get('/cart', 'ShoppingCartController@fetch')->name("shopping_cart_fetch");
Route::get('/admin', 'AdminController@index');
Route::post('/admin/update_product', 'AdminController@update')->name("update_product");
Route::post('/admin/create_product', 'AdminController@create')->name("create_product");
Route::post('/admin/delete', 'AdminController@delete')->name("delete_product");
