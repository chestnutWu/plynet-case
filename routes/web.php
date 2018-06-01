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

Route::get('/', function () {return view('welcome');});
//最新消息
Route::group(['prefix'=>'news'],function(){
    Route::get('/','NewsController@newsPageList');
    Route::post('/create','NewsController@newsCreate');
    Route::delete('/{news_id}/delete','NewsController@newsDelete');
    Route::put('/{news_id}/update','NewsController@newsUpdate');
});
//特價清倉
Route::group(['prefix'=>'tickets'],function(){
    Route::get('/','TicketsController@ticketsPageList');
    Route::post('/create','TicketsController@ticketsCreate');
    Route::post('/batch/create','TicketsController@ticketsBatchCreate');
    Route::delete('/{ticket_id}/delete','TicketsController@ticketsDelete');
    Route::put('/{tickets_id}/update','TicketsController@ticketsUpdate');
});
//訂單查詢
Route::group(['prefix'=>'orders'],function(){
    Route::get('/','OrdersController@ordersPageList');
    Route::put('/{order_id}/update/{status}','OrdersController@orderUpdate');
});