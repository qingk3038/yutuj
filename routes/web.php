<?php

Route::domain('m.yutuj.com')->group(function () {
    Route::get('/', 'MController@index');
});

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
Route::get('home/order', 'HomeController@order')->name('home.order');
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

// 活动
Route::get('activity/show/{activity}', 'ShowController@activity')->name('www.activity.show');
Route::get('activity/list', 'ListController@activity')->name('www.activity.list');

// 攻略
Route::get('raider/show/{raider}', 'ShowController@raider')->name('www.raider.show');
Route::get('raider/list', 'ListController@raiders')->name('www.raider.list');

// 领队
Route::get('leader/show/{leader}', 'ShowController@leader')->name('www.leader.show');
Route::get('leader/list/{province?}', 'ListController@leaders')->name('www.leader.list');

// 游记
Route::get('travel/show/{travel}', 'ShowController@travel')->name('www.travel.show');
Route::get('travel/list', 'ListController@travel')->name('www.travel.list');

// 用户的游记列表
Route::get('travel/list/{user}', 'ListController@userTravel')->name('www.user.travel');

// 视频
Route::get('video/show/{video}', 'ShowController@video')->name('www.video.show');
Route::get('video/list', 'ListController@video')->name('www.video.list');

// 文章
Route::get('article/show/{article}', 'ShowController@article')->name('www.article.show');

// 搜索
Route::get('search', 'ListController@search')->name('search');

// 报名页面
Route::get('tuan/{tuan}', 'PayController@create')->name('pay.order.create');
// 填写报名信息的提交
Route::post('tuan/{tuan}', 'PayController@store');
// 显示二维码的支付页面和支付结果
Route::get('order/{order}/pay', 'PayController@showQrcode')->name('order.qrcode');
// 生成微信订单
Route::get('pay/wechat/{order}', 'PayController@wechat')->name('pay.wechat');
// 订单支付状态
Route::get('pay/status/{order}', 'PayController@orderStatus')->name('pay.status');

// 微信异步通知
Route::post('notice/wechat', 'PayController@wechatNotice');

// 生成支付宝订单 二维码
Route::get('pay/alipay/{order}', 'PayController@alipay')->name('pay.alipay');
// 支付宝官方网站支付
Route::get('pay/alipay/{order}/web', 'PayController@alipayWeb')->name('pay.alipay.web');

// 支付宝异步通知
Route::post('notice/alipay', 'PayController@alipayNotice');
// 支付宝同步通知
Route::get('notice/alipay/return', 'PayController@alipayReturn');

