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
use Illuminate\Support\Facades\Artisan;
Route::get('/', function () {return view('welcome');});

//最新消息路由
Route::group(['prefix'=>'news'],function(){
    Route::group(['middleware' => ['auth']],function(){
        Route::get('/','NewsController@newsPageList');
        Route::post('/create','NewsController@newsCreate');
        Route::delete('/{news_id}/delete','NewsController@newsDelete');
        Route::put('/{news_id}/update','NewsController@newsUpdate');
    });
});

//特價清倉路由
Route::group(['prefix'=>'tickets'],function(){
    Route::group(['middleware' => ['auth']],function(){
        Route::get('/','TicketsController@ticketsPageList');
        Route::post('/create','TicketsController@ticketsCreate');
        Route::post('/batch/create','TicketsController@ticketsBatchCreate');
        Route::delete('/{ticket_id}/delete','TicketsController@ticketsDelete');
        Route::put('/{tickets_id}/update','TicketsController@ticketsUpdate');
    });
});
//出去走走路由
Route::group(['prefix'=>'travels'],function(){
    Route::group(['middleware' => ['auth']],function(){
        Route::get('/','TravelsController@travelsPageList');
        Route::post('/create','TravelsController@travelCreate');
        Route::delete('/{travel_id}/delete','TravelsController@travelDelete');
        Route::put('/{travel_id}/update','TravelsController@travelUpdate');
    });   
});
//旅遊必備路由
Route::group(['prefix'=>'items'],function(){
    Route::group(['middleware'=>['auth']],function(){
        Route::get('/','ItemsController@itemsPageList');
        Route::post('/create','ItemsController@itemCreate');
        Route::delete('/{item_id}/delete','ItemsController@itemDelete');
        Route::put('/{item_id}/update','ItemsController@itemUpdate');
    });
});
//旅遊資訊路由
Route::group(['prefix'=>'information'],function(){
   Route::group(['middleware'=>['auth']],function(){
        Route::get('/','InformationController@informationPageList');
        Route::post('/create','InformationController@informationCreate');
        Route::delete('/{information_id}/delete','InformationController@informationDelete');
        Route::put('/{information_id}/update','InformationController@informationUpdate');
   }); 
});

//訂單查詢路由
Route::group(['prefix'=>'orders'],function(){
    Route::group(['middleware' => ['auth']],function(){
        Route::get('/','OrdersController@ordersPageList');
        Route::put('/{order_id}/update/{status}','OrdersController@orderUpdate');
    });
});

//身分驗證、註冊、密碼重設路由
Auth::routes(); //https://stackoverflow.com/questions/42695917/laravel-5-4-disable-register-route
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->middleware(['auth'])->name('register');

//migration Route
Route::get('/migrate', function()
{
    Artisan::call('migrate');
});