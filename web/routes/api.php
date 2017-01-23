<?php

use Illuminate\Http\Request;

Route::group(['namespace' => 'API'], function () {
	Route::post('/user', 'User\UserApiController@save');
	Route::post('/login', 'Auth\AuthApiController@login');
	Route::post('/logout', 'Auth\AuthApiController@logout');
});

//Route::group(['namespace' => 'API\Auth'], function () {
//	Route::post('/login', 'AuthApiController@login');
//});

