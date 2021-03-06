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

Route::group(['prefix' => 'auth', 'namespace' => 'Authenticate'], function () {
    Route::get('login', 'LoginController');
    Route::post('login', 'LoginController');
    Route::post('register', 'RegisterController');
    Route::post('logout', 'LogoutController');
    Route::get('me', 'MeController');
});

Route::group(['prefix' => 'frontend', 'namespace' => 'Frontend'], function () {
    Route::get('role', 'AccountController@showRole');

    Route::get('/user', 'AccountController@showMe');
    Route::post('/useredit', 'AccountController@editUser');

    Route::get('users', 'AccountController@showUsers');  
    Route::get('/user/{id}', 'AccountController@showUser');
    Route::get('/userposts', 'AccountController@showUserPosts');
    Route::get('/userpost/delete/{id}', 'AccountController@deleteUserPost');
    Route::post('/searchusers', 'AccountController@searchUsers');

    Route::get('/usersettings', 'AccountController@showUserSettings');
    Route::post('/usersettingsedit', 'AccountController@editUserSettings');

    Route::get('/relation/{id}', 'AccountController@showRelation');
    Route::post('/updaterelation', 'AccountController@updateRelation');

    Route::post('/user/review', 'AccountController@postReview');
    Route::get('/userreviews', 'AccountController@showUserReviews');
    Route::get('/profilereviews/{id}', 'AccountController@showProfileReviews');
    Route::get('/userpostedreviews', 'AccountController@showPostedReviews');

    Route::get('/postsnew', 'AccountController@showNewPosts');
    Route::get('/poststop', 'AccountController@showTopPosts');
    Route::get('/postsliked', 'AccountController@showLikedPosts');
    Route::get('/post/{id}', 'AccountController@showPost');
    Route::post('/post/create', 'AccountController@createPost');
    Route::post('/postlike', 'AccountController@likePost');

    Route::get('/news', 'AccountController@getNews');

    Route::post('/post/comment', 'AccountController@createComment');

    Route::get('/friends', 'AccountController@showFriends');

    Route::post('/addusergame', 'AccountController@addUserGame');
    Route::post('/removeusergame', 'AccountController@removeUserGame');
    Route::get('/usergamesunadded', 'AccountController@getUserGamesUnadded');

    
    Route::get('/usergames', 'AccountController@showUserGameData');
    Route::get('/profilegames/{id}', 'AccountController@showProfileGameData');
    Route::get('/queuegames', 'AccountController@showQueueGames');


    Route::post('/queue', 'AccountController@queue');
    Route::get('/lounge/{id}', 'AccountController@lounge');
    Route::get('/exitlounge', 'AccountController@exitLounge');


    Route::get('/conversation/{id}', 'AccountController@showMessagesFor');
    Route::post('/conversation/send', 'AccountController@sendMessageTo');

    // pusher/real time 
    Route::post('/pusher/auth', 'AccountController@pusherAuth');
    Route::post('/userstatus', 'AccountController@userStatus');

    // report
    Route::post('/addreport', 'AccountController@addReport');

    // group message
    Route::post('/groupmessage', 'AccountController@sendGroupMessage');

    // mode
    Route::post('/mode', 'AccountController@nightmode');
});


