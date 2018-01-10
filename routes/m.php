<?php

// 登录
Route::view('login', 'm.auth/login')->middleware('guest');
// 注册
Route::view('register', 'm.auth/register')->middleware('guest');
// 忘记密码
Route::view('password/reset', 'm.auth.forgot')->name('password.request')->middleware('guest');

// 首页
Route::get('/', 'Mobile\WebController@index');
// 加载首页导航的活动
Route::get('nav/{nav}/activities', 'Mobile\WebController@loadActivities');


Route::get('activity/show/{activity}', 'Mobile\ShowController@activity')->name('m.activity.show');

Route::get('raider/show/{raider}', 'Mobile\ShowController@raider')->name('m.raider.show');

Route::get('leader/show/{leader}', 'Mobile\ShowController@leader')->name('m.leader.show');


Route::view('home', 'm.home.index');

Route::resource('home/travel', 'Mobile\TravelController')->names('home.travel');

Route::get('home/order', 'Mobile\HomeController@order')->name('home.order');
Route::get('home/order/{order}/show', 'Mobile\HomeController@orderInfo')->name('home.order.show');

Route::view('home/setting', 'm.home.setting')->name('home.setting')->middleware('auth');
Route::view('home/message', 'm.home.message')->name('home.message')->middleware('auth');



//// 游记
//Route::resource('home/travel', 'TravelController');
//// 会员中心
//Route::redirect('home', 'home/travel')->name('home');
//Route::view('home/setting', 'm.home.setting')->name('home.setting')->middleware('auth');
//Route::view('home/message', 'm.home.message')->name('home.message')->middleware('auth');
//Route::get('home/order', 'HomeController@order')->name('home.order');
//Route::get('home/order/{order}/show', 'HomeController@orderInfo')->name('home.order.show');
//Route::view('home/order/info', 'm.home.order_info')->name('home.order.info')->middleware('auth');
//// 定制游
//Route::view('customized', 'm.customized');
//// 活动
//Route::get('activity/show/{activity}', 'ShowController@activity')->name('m.activity.show');
//Route::get('activity/list', 'ListController@activity')->name('m.activity.list');
//// 攻略
//Route::get('raider/show/{raider}', 'ShowController@raider')->name('m.raider.show');
//Route::get('raider/list', 'ListController@raiders')->name('m.raider.list');
//// 领队
//Route::get('leader/show/{leader}', 'ShowController@leader')->name('m.leader.show');
//Route::get('leader/list/{province?}', 'ListController@leaders')->name('m.leader.list');
//// 游记
//Route::get('travel/show/{travel}', 'ShowController@travel')->name('m.travel.show');
//Route::get('travel/list', 'ListController@travel')->name('m.travel.list');
//// 用户的游记列表
//Route::get('travel/list/{user}', 'ListController@userTravel')->name('m.user.travel');
//// 视频
//Route::get('video/show/{video}', 'ShowController@video')->name('m.video.show');
//Route::get('video/list', 'ListController@video')->name('m.video.list');
//// 文章
//Route::get('article/show/{article}', 'ShowController@article')->name('m.article.show');
//// 搜索
//Route::get('search', 'ListController@search')->name('search');
//// 报名页面
//Route::get('tuan/{tuan}', 'PayController@create')->name('pay.order.create');
//// 显示二维码的支付页面和支付结果
//Route::get('order/{order}/pay', 'PayController@showQrcode')->name('order.qrcode');

