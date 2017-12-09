<?php

Route::view('/', 'www.index');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/register', 'Auth\RegisterController@showRegistrationForm');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/forgot', 'Auth\RegisterController@showRegistrationForm');

//短信
Route::post('/sms/register', 'SmsController@register');
Route::post('/sms/forgot', 'SmsController@forgot');
Route::post('/sms/update', 'SmsController@update');

//Auth::routes();