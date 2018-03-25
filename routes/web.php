<?php

Auth::routes();
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::post('password/mobile', 'Auth\ForgotPasswordController@mobile')->name('password.mobile');
// 图片上传
Route::post('upload/images', 'WebController@uploadImages');
// 缩略图
Route::get('thumb/{width}/{height}/{url}', 'ThumbController')->name('thumb');
//短信
Route::post('sms/register', 'SmsController@register');
Route::post('sms/forgot', 'SmsController@forgot');
Route::post('sms/update', 'SmsController@update');
// 上传游记封面
Route::post('home/travel/thumb/{travel}', 'TravelController@updateThumb');
// 设置中心
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
Route::post('customized', 'CustomizedController@store');
// 提交报名信息
Route::post('tuan/{tuan}', 'PayController@store');
// 订单支付状态
Route::get('pay/status/{order}', 'PayController@orderStatus')->name('pay.status');
// 微信异步通知
Route::post('notice/wechat', 'PayController@wechatNotice');
// 支付宝异步通知
Route::post('notice/alipay', 'PayController@alipayNotice');
// 支付宝同步通知
Route::get('notice/alipay/return', 'PayController@alipayReturn');
// 支付宝官方网站支付
Route::get('pay/alipay/{order}/web', 'PayController@alipayWeb')->name('pay.alipay.web');
// 微信公众号接口 -- 未开发
Route::any('wechat', 'WechatController');
// 微信登录
Route::get('oauth/login/wechat', 'WebController@loginWechat')->name('oauth.wechat');
// 微信登录回调
Route::get('oauth/callback/wechat', 'WebController@callbackWechat')->middleware('wechat.oauth');
Route::get('oauth/callback/wechatopen', 'WebController@callbackWechatOpen');