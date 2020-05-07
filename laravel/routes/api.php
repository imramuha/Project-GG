<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

 /*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
    Route::post('login', 'LoginController');
    Route::post('register', 'RegisterController');
    Route::post('logout', 'LogoutController');
    Route::get('me', 'MeController');
});

Route::get('role', 'Frontend\AccountController@showRole');

Route::group(['prefix' => 'frontend', 'namespace' => 'Frontend'], function () {
    Route::get('role', 'AccountController@showRole');

    Route::get('users', 'AccountController@showUsers');
    
    Route::get('/user/{id}', 'AccountController@showUser');

    Route::get('/posts', 'AccountController@showPosts');
    Route::get('/userposts', 'AccountController@showUserPosts');
    Route::get('/users/{id}', 'AccountController@showUserRelation');

    Route::get('/friends', 'AccountController@showFriends');
});