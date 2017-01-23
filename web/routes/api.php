<?php

use Illuminate\Http\Request;

Route::group(['namespace' => 'API', 'middleware' => 'auth.api'], function () {
	Route::post('/user', 'User\UserApiController@save');
	Route::get('/user', 'User\UserApiController@getUserData');
	Route::post('/logout', 'Auth\AuthApiController@logout');
});

Route::group(['namespace' => 'API'], function () {
	Route::post('/login', 'Auth\AuthApiController@login');
});

//Route::group(['namespace' => 'API\Auth'], function () {
//	Route::post('/login', 'AuthApiController@login');
//});

