<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {return view('table');});
Route::group(['prefix'=>'news'],function(){
    Route::get('/','NewsController@newsPageList');
    Route::post('/create','NewsController@newsCreate');
    Route::delete('/{news_id}/delete','NewsController@newsDelete');
    Route::put('/{news_id}/update','NewsController@newsUpdate');
});
Route::group(['prefix'=>'orders'],function(){
    Route::get('/','OrdersController@ordersPageList');
    Route::put('/{order_id}/update/{status}','OrdersController@orderUpdate');
});