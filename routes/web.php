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

Route::middleware(['guest'])->group(function() {
	Route::get('/signup', 'AuthController@getSignUp')->name('auth.signup');
	Route::post('/signup', 'AuthController@postSignUp');

	Route::get('/signin', 'AuthController@getSignIn')->name('auth.signin');
	Route::post('/signin', 'AuthController@postSignIn');
});

Route::middleware(['auth'])->group(function() {
	Route::get('/signout', 'AuthController@getSignOut')->name('auth.signout');

	Route::get('/search', 'SearchController@getResults')->name('search.results');

	Route::get('/user/{username}', 'ProfileController@getProfile')->name('profile.index');

	Route::get('/profile/edit', 'ProfileController@getEdit')->name('profile.edit');
	Route::post('/profile/edit', 'ProfileController@postEdit');

	Route::get('/friends', 'FriendController@getIndex')->name('friend.index');
	Route::get('/friends/add/{username}', 'FriendController@getAdd')->name('friend.add');
	Route::get('/friends/accept/{username}', 'FriendController@getAccept')->name('friend.accept');
	Route::post('/friends/delete/{username}', 'FriendController@postDelete')->name('friend.delete');

	Route::post('/status', 'StatusController@postStatus')->name('status.post');
	Route::post('/status/{statusId}/reply', 'StatusController@postReply')->name('status.reply');
	Route::get('/status/{statusId}/like', 'StatusController@getLike')->name('status.like');
});

