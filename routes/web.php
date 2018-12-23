<?php

require 'helpers/route.php';

Route::get('/', 'UserController@index');
Route::get('/user', 'UserController@index');
Route::get('/user/{id}', 'UserController@show');
Route::get('/user/create', 'UserController@create');
Route::get('/user/update/{userId}', 'UserController@update');

Route::get('/post', 'PostController@index');
Route::get('/post/{id}', 'PostController@show');
Route::post('/post/create', 'PostController@create');
