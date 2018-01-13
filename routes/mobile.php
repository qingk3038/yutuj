<?php
// 手机网路由

// 登录
Route::view('login', 'm.auth/login')->name('login')->middleware('guest');
// 注册
Route::view('register', 'm.auth/register')->name('register')->middleware('guest');
// 忘记密码
Route::view('password/reset', 'm.auth.forgot')->name('password.request')->middleware('guest');
// 首页
Route::get('/', 'Mobile\WebController@index');
// 加载首页导航的活动
Route::get('nav/{nav}/activities', 'Mobile\WebController@loadActivities');
// 活动
Route::get('activity/show/{activity}', 'Mobile\ShowController@activity')->name('m.activity.show');
Route::get('activity/list', 'Mobile\ListController@activity')->name('m.activity.list');
// 攻略
Route::get('raider/show/{raider}', 'Mobile\ShowController@raider')->name('m.raider.show');
Route::get('raider/list', 'Mobile\ListController@raiders')->name('m.raider.list');
// 领队
Route::get('leader/show/{leader}', 'Mobile\ShowController@leader')->name('m.leader.show');
// 主页
Route::view('home', 'm.home.index')->name('home');
Route::get('home/order', 'Mobile\HomeController@order')->name('home.order');
Route::get('home/order/{order}/show', 'Mobile\HomeController@orderInfo')->name('home.order.show');
Route::resource('home/travel', 'Mobile\TravelController')->names('home.travel');
Route::get('home/setting/{edit?}', 'Mobile\HomeController@index')->name('home.setting');
Route::view('home/message', 'm.home.message')->name('home.message')->middleware('auth');
// 报名页面
Route::get('tuan/{tuan}', 'Mobile\PayController@create')->name('pay.order.create');
// Wap支付
Route::get('order/{order}/wap', 'Mobile\PayController@pay')->name('order.pay');
// 显示支付结果
Route::get('order/{order}/pay', 'Mobile\PayController@showQrcode')->name('order.qrcode');

// 定制游
Route::view('customized', 'm.customized');