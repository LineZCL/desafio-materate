<?php
Route::get('/', 'HomeController@index');

Route::group(['namespace' => 'Auth'], function () {
	Route::get('/login', 'LoginController@index');
	Route::post('/login', 'LoginController@login');
	Route::post('/logout', 'LoginController@logout');
});


Route::group(['namespace' => 'Web', 'middleware' => 'auth'], function () {
	Route::get('/users', 'UserController@list');
	Route::get('/deleted-users', 'UserController@deletedUsers');
	Route::get('/user/delete/{userId}',[
		'uses' => 'UserController@delete',
		'as'   => 'delete_user'
		]);
	
});
