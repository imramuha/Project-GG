<?php

use Illuminate\Support\Facades\Route;

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
    return redirect('backoffice/dashboard');
});


Route::middleware(['auth:web'])->group(function () {
    Route::get('backoffice/dashboard', 'backoffice\DashboardController@index');
});

Route::group(['prefix' => 'backoffice', 'namespace' => 'Backoffice'], function () {
    
    // using web guard cause I set api for frontend
    Route::middleware(['web'])->group(function () {
        Route::resource('users', 'UserController');

        Route::get('dashboard', [ 
            'uses' => 'DashboardController@index',
            'as' => 'dashboard',
        ]);;

        Route::resource('users', 'UserController');
        Route::resource('posts', 'PostController');
        Route::resource('games', 'GameController');
        Route::resource('reviews', 'ReviewController');
        Route::resource('reports', 'ReportController');
        Route::resource('news', 'NewsController');
        Route::resource('comments', 'CommentController');

    });
});


Route::get('/admin', 'Backoffice\Auth\AdminController@index'); 
Route::get('/mod', 'Backoffice\Auth\ModController@index');
Route::get('/no-acces', 'Backoffice\Auth\NoAccesController@index');

Route::get('/login', 'Backoffice\Auth\LoginController@showLoginForm');
Route::post('/login', 'Backoffice\Auth\LoginController@login')->name('login');
Route::post('/logout', 'Backoffice\Auth\LoginController@logout')->name('logout');


