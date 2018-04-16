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
Route::group(['prefix'=>'latestNews'],function(){
    Route::get('/','LatestNewsController@latestNewsPageList');
    Route::post('/create','LatestNewsController@latestNewsCreate');
    Route::delete('/{news_id}/delete','LatestNewsController@latestNewsDelete');
    Route::put('/{news_id}/update','LatestNewsController@latestNewsUpdate');
});