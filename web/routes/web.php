<?php
Route::get('/', 'HomeController@index');

Route::group(['namespace' => 'Auth'], function () {
	Route::get('/login', 'LoginController@index');
	Route::post('/login', 'LoginController@login');
	Route::post('/logout', 'LoginController@logout');

});
