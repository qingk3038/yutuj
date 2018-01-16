<?php
// 手机网路由

// 首页
Route::get('/', 'Mobile\WebController@index');
// 活动
Route::get('activity/show/{activity}', 'Mobile\ShowController@activity')->name('activity.show');
Route::get('activity/list', 'Mobile\ListController@activity')->name('activity.list');
// 攻略
Route::get('raider/show/{raider}', 'Mobile\ShowController@raider')->name('raider.show');
Route::get('raider/list', 'Mobile\ListController@raiders')->name('raider.list');
// 领队
Route::get('leader/show/{leader}', 'Mobile\ShowController@leader')->name('leader.show');
Route::get('leader/list/{province?}', 'Mobile\ListController@leaders')->name('leader.list');
// 主页
Route::view('home', 'm.home.index')->name('home');
Route::get('home/order', 'Mobile\HomeController@order')->name('home.order');
Route::get('home/order/{order}/show', 'Mobile\HomeController@orderInfo')->name('home.order.show');
Route::resource('home/travel', 'Mobile\TravelController')->names('home.travel');
Route::get('home/setting/{edit?}', 'Mobile\HomeController@index')->name('home.setting');
Route::get('home/message', 'Mobile\HomeController@message')->name('home.message');
Route::delete('home/message/{message}', 'HomeController@destroyMessages')->name('user.message.destroy');
Route::put('home/message/{message}', 'HomeController@readMessages')->name('user.message.read');
// 报名页面
Route::get('tuan/{tuan}', 'Mobile\PayController@create')->name('pay.order.create');
// Wap支付
Route::get('order/{order}/wap', 'Mobile\PayController@pay')->name('order.pay');
// 显示支付结果
Route::get('order/{order}/pay', 'Mobile\PayController@showQrcode')->name('order.qrcode');
// 定制游
Route::view('customized', 'm.customized');
// 视频
Route::get('video/show/{video}', 'Mobile\ShowController@video')->name('video.show');
Route::get('video/list', 'Mobile\ListController@video')->name('video.list');
// 文章
Route::get('article/show/{article}', 'Mobile\ShowController@article')->name('article.show');
// 搜索
Route::get('search', 'Mobile\ListController@search')->name('search');
// 游记
Route::get('travel/show/{travel}', 'Mobile\ShowController@travel')->name('travel.show');
Route::get('travel/list', 'Mobile\ListController@travel')->name('travel.list');
// 用户的游记列表
Route::get('travel/list/{user}', 'Mobile\ListController@userTravel')->name('user.travel');


