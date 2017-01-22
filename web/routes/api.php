<?php

use Illuminate\Http\Request;

Route::group(['namespace' => 'API'], function () {
	Route::post('/user', 'UserApiController@save');
});

