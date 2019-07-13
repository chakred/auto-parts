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

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth']], function(){
    Route::get('/', 'DashboardController@dashboard')->name('admin.index');
    Route::get('/mark-auto', 'MarkAutoController@index')->name('mark-auto');
    Route::post('/mark-auto', 'MarkAutoController@store')->name('store-mark-auto');

    Route::get('/model-auto', 'ModelAutoController@index')->name('model-auto');
    Route::get('/model-auto/add', 'ModelAutoController@add')->name('add-model-auto');
    Route::post('/model-auto/add', 'ModelAutoController@store')->name('store-model-auto');
    Route::delete('/model-auto/{model}', 'ModelAutoController@destroy')->name('model-auto-delete');
    Route::get('/model-auto/edit/{id}', 'ModelAutoController@edit')->name('edit-model-auto');
    Route::put('/model-auto/edit/{id}', 'ModelAutoController@update')->name('update-model-auto');

    Route::get('/categories', 'CategoriesController@index')->name('categories');
    Route::post('/categories', 'CategoriesController@store')->name('store-category');
    Route::delete('/categories/{category}', 'CategoriesController@destroy')->name('category-delete');
    Route::put('/categories/edit/{id}', 'CategoriesController@update')->name('category-edit');

    Route::get('/sub-categories', 'SubCategoriesController@index')->name('sub-categories');
    Route::post('/sub-categories', 'SubCategoriesController@store')->name('store-sub-category');
    Route::put('/sub-categories/edit/{id}', 'SubCategoriesController@update')->name('sub-category-edit');
    Route::delete('/sub-categories/{sub-category}', 'SubCategoriesController@destroy')->name('sub-category-delete');

    Route::get('/further-sub-categories', 'FurtherSubCategoriesController@index')->name('further-sub-categories');
    Route::post('/further-sub-categories', 'FurtherSubCategoriesController@store')->name('further-sub-category-store');
    Route::put('/further-sub-categories/edit/{id}', 'FurtherSubCategoriesController@update')->name('further-sub-category-edit');
    Route::delete('/further-sub-categories/{further-sub-category}', 'FurtherSubCategoriesController@destroy')->name('further-sub-category-delete');

    Route::get('/goods', 'GoodsController@index')->name('goods');
    Route::get('/goods/add', 'GoodsController@add')->name('add-goods');
    Route::post('/goods/add', 'GoodsController@store')->name('store-goods');
    Route::get('/goods/edit/{id}', 'GoodsController@edit')->name('edit-goods');
    Route::put('/goods/edit/{id}', 'GoodsController@update')->name('update-goods');
    Route::delete('/goods/{id}', 'GoodsController@destroy')->name('delete-goods');

    Route::get('/orders', 'OrdersController@index')->name('orders');
    Route::get('/orders/edit/{id}', 'OrdersController@edit')->name('edit-order');
    Route::put('/orders/edit/{id}', 'OrdersController@update')->name('update-order');
    Route::delete('/orders/delete/{id}', 'OrdersController@destroy')->name('delete-order');
});

Route::get('/', 'Web\FrontPageController@index')->name('front-page');
Route::get('categories/{id}', 'Web\CategoriesController@index')->name('categories-site');
Route::get('sub-categories/{category}/{model}', 'Web\SubCategoriesController@index')->name('sub-categories-site');
Route::get('further-sub-categories/{subCategory}/{model}', 'Web\FurtherSubCategoriesController@index')->name('further-sub-categories-site');
Route::get('products/{subCategory}/{furtherSubCategory?}/{model}', 'Web\GoodsController@index')->name('goods-site');
Route::get('product/{subCategory}/{model}/{id}', 'Web\GoodsSingleController@index')->name('goods-single-site');
Route::post('products/order', 'Web\OrderController@store')->name('store-order');
Route::any('/search','Web\GoodsController@search')->name('search-for-goods');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

