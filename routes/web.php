<?php

// 首页
Route::get('/', 'WebController@index');

//短信
Route::post('sms/register', 'SmsController@register');
Route::post('sms/forgot', 'SmsController@forgot');
Route::post('sms/update', 'SmsController@update');

// 登录
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

// 注册
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// 忘记密码
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/mobile', 'Auth\ForgotPasswordController@mobile')->name('password.mobile');

// 找回密码
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

// 游记
Route::post('home/travel/thumb/{travel}', 'TravelController@updateThumb');
Route::resource('home/travel', 'TravelController');

// 会员中心
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

// 游记点赞
Route::post('travel/like/{travel}', 'HomeController@likeTravel');

// 是否已为粉丝
Route::get('user/fans/{user}', 'HomeController@isFans');

// 切换成为粉丝
Route::post('user/fans/{user}', 'HomeController@fans');

// 定制游
Route::view('customized', 'www.customized');
Route::post('customized', 'CustomizedController@store');

// 缩略图
Route::get('thumb/{width}/{height}/{url}', 'ThumbController')->name('thumb');

// 活动详情
Route::get('activity/show/{activity}', 'ShowController@activity')->name('www.activity.show');

// 攻略详情
Route::get('raider/show/{raider}', 'ShowController@raider')->name('www.raider.show');

// 领队
Route::get('leader/show/{leader}', 'ShowController@leader')->name('www.leader.show');
Route::get('leader/list/{province?}', 'ListController@leaders')->name('www.leader.list');

// 游记详情
Route::get('travel/show/{travel}', 'ShowController@travel')->name('www.travel.show');

// 用户的游记列表
Route::get('travel/list/{user}', 'ListController@userTravel')->name('www.user.travel');
