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

Route::get('/', 'HomeController@index');

Auth::routes();

Route::group(['prefix' => 'app', 'namespace' => 'App', 'middleware' => ['auth']], function () {

	Route::get('/', function() {
	    return redirect('/app/dashboard');
	});

    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('/profile', 'ProfileController@index')->name('profile');
    Route::get('/profile/edit', 'ProfileController@edit')->name('profile.edit');
    Route::resource('/orders', 'TradingHistoryController', ['only' => ['index','store']]);
    Route::resource('/follows', 'FollowController', ['only' => ['index','store']]);

    //Route::get('/orders/add', 'TradingHistoryController@add');

    Route::group(['middleware' => ['role:admin']], function () {
        Route::resource('user', 'BlogController'); //Make a CRUD controller
    });
});



