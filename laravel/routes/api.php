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

    Route::get('/user', 'AccountController@showMe');
    Route::post('/user/edit', 'AccountController@editMe');

    Route::get('users', 'AccountController@showUsers');  
    Route::get('/user/{id}', 'AccountController@showUser');
    Route::get('/userposts', 'AccountController@showUserPosts');
    Route::get('/userpost/delete/{id}', 'AccountController@deleteUserPost');
    Route::get('/users/{id}', 'AccountController@showUserRelation');

    Route::post('/user/review', 'AccountController@postReview');

    Route::get('/posts', 'AccountController@showPosts');
    Route::get('/post/{id}', 'AccountController@showPost');

    Route::post('/post/comment', 'AccountController@postComment');

    Route::get('/friends', 'AccountController@showFriends');

    Route::get('/games', 'AccountController@showUserGameData');


    // Route::get('/example', 'AccountController@showExample');
});