<?php
/*************************************************
 * TheYkk's fw
 * Routes
 *
 * Author 	: Yusuf Kaan Karakaya
 * Web 		: http://theykk.net
  *
 * Github	: http://github.com/theykk/fw
 * License	: MIT
 *
 *************************************************/
use System\Libs\Router\Router as Route;

Route::set404(function(){
	header('HTTP/1.1 404 Not Found');
	View::render('errors.404');
});

Route::namespace('frontend')->group(function(){
	Route::get('/', 'Home@index');

});

Route::prefix('frontend')->namespace('frontend')->group(function(){
	Route::any('/', 'Home@index');
	Route::get('/home', 'Home@index');
});

Route::prefix('backend')->namespace('backend')->group(function(){
	Route::get('/', 'Dashboard@index');
	Route::get('/dashboard', 'Dashboard@index');
});


//Log router
Route::prefix('log')->middleware(['developer'])->group(function(){
    Route::get('/',function (){
        Log::show();
    });
    Route::get('/{day}', function ($day){
        Log::show($day);
    })->where(['day' => '{digit}']);
});