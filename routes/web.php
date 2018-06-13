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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::group(['prefix' => 'app', 'namespace' => 'App', 'middleware' => ['auth']], function () {

    Route::get('/dashboard', 'DashboardController@index');
    Route::get('/manage', ['middleware' => ['permission:manage-admins'], 'uses' => 'AdminController@manageAdmins']);

    Route::group(['middleware' => ['role:admin']], function () {
        Route::resource('blog', 'BlogController'); //Make a CRUD controller
    });
});



