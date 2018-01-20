<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix' => config('admin.route.prefix'),
    'namespace' => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->post('upload/images', 'HomeController@images');
    $router->get('api/province', 'LocListController@province');
    $router->get('api/city', 'LocListController@city');
    $router->get('api/district', 'LocListController@district');

    $router->resource('web/user', 'UserController')->names('admin.user');
    $router->resource('web/travel', 'TravelController')->names('admin.travel');
    $router->resource('locList', 'LocListController')->names('admin.locList');
    $router->resource('leader', 'LeaderController')->names('admin.leader');
    $router->resource('web/category', 'CategoryController')->names('admin.category');
    $router->resource('web/article', 'ArticleController')->names('admin.article');
    $router->resource('nav', 'NavController')->names('admin.nav');
    $router->resource('tag', 'TagController')->names('admin.tag');
    $router->resource('type', 'TypeController')->names('admin.type');
    $router->resource('activity', 'ActivityController')->names('admin.activity');
    $router->resource('raider', 'RaiderController')->names('admin.raider');
    $router->resource('customized', 'CustomizedController')->names('admin.customized');
    $router->resource('order', 'OrderController')->names('admin.order');
    $router->resource('video', 'VideoController')->names('admin.video');
});
