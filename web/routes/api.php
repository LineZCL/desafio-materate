<?php

use Illuminate\Http\Request;
Route::group(['middleware' => 'cors'], function () {
	Route::group(['namespace' => 'API', 'middleware' => 'auth.api'], function () {
		Route::put('/user', 'User\UserApiController@edit');
		Route::get('/user', 'User\UserApiController@getUserData');
		Route::post('/logout', 'Auth\AuthApiController@logout');
	});
});

Route::group(['namespace' => 'API', 'middleware' => 'cors'], function () {
	Route::post('/user', 'User\UserApiController@create');
	Route::post('/login', 'Auth\AuthApiController@login');
});
