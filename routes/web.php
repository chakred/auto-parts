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

    Route::get('/sub-categories', 'SubCategoriesController@index')->name('sub-categories');
    Route::post('/sub-categories', 'SubCategoriesController@store')->name('store-sub-category');
    Route::delete('/sub-categories/{sub-category}', 'SubCategoriesController@destroy')->name('sub-category-delete');

    Route::get('/goods', 'GoodsController@index')->name('goods');
    Route::get('/goods/add', 'GoodsController@add')->name('add-goods');
    Route::post('/goods/add', 'GoodsController@store')->name('store-goods');
    Route::get('/goods/edit/{id}', 'GoodsController@edit')->name('edit-goods');
    Route::put('/goods/edit/{id}', 'GoodsController@update')->name('update-goods');
    Route::delete('/goods/{id}', 'GoodsController@destroy')->name('delete-goods');

});

Route::get('/', 'Web\FrontPageController@index')->name('front-page');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
