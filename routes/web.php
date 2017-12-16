<?php

Route::view('/', 'www.index');

//短信
Route::post('sms/register', 'SmsController@register');
Route::post('sms/forgot', 'SmsController@forgot');
Route::post('sms/update', 'SmsController@update');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/mobile', 'Auth\ForgotPasswordController@mobile')->name('password.mobile');

Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

// 游记
Route::resource('home/travel', 'TravelController');

Route::redirect('home', 'home/travel')->name('home');
Route::view('home/setting', 'www.home.setting')->name('home.setting');
Route::view('home/message', 'www.home.message')->name('home.message');
Route::view('home/order', 'www.home.order')->name('home.order');
Route::view('home/order/info', 'www.home.order_info')->name('home.order.info');

Route::post('home/bg', 'HomeController@backgroundImage')->name('user.bg');
Route::post('home/avatar', 'HomeController@uploadAvatar')->name('user.avatar');
Route::put('home/user', 'HomeController@update')->name('user.update');
Route::put('home/pwd', 'HomeController@updatePwd')->name('user.pwd');
Route::put('home/mobile', 'HomeController@updateMobile')->name('user.mobile');

Route::view('customized', 'www.customized');
Route::post('customized', 'CustomizedController@store');