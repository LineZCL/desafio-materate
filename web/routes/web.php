<?php

Route::group(['namespace' => 'Web'], function () {

	Route::group(['namespace' => 'Auth'], function () {
		Route::get('/login', 'LoginController@index');
		Route::post('/login', 'LoginController@login');
		Route::post('/logout', [
			'uses' => 'LoginController@logout', 
			'middleware' => 'auth' 
			]);
	});
	Route::group(['namespace' => 'User', 'middleware' => 'auth'], function () {
		Route::get('/', 'UserController@list');
		
		Route::get('/deleted-users', 'UserController@deletedUsers');
		
		Route::get('/user/delete/{userId}',[
			'uses' => 'UserController@delete',
			'as'   => 'delete_user'
			]);
		
		Route::get('/user/{userId}',[
			'uses' => 'UserController@edit',
			'as'   => 'edit_user'
			]);
		Route::post('/user', 'UserController@save');
	});

});
