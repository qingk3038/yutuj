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
    $router->resource('web/user', 'UserController');
    $router->resource('web/travel', 'TravelController');

    $router->resource('locList', 'LocListController');

    $router->get('api/province', 'LocListController@province');
    $router->get('api/city', 'LocListController@city');
    $router->get('api/district', 'LocListController@district');

    $router->resource('leader', 'LeaderController');

    $router->resource('web/category', 'CategoryController');
    $router->resource('web/article', 'ArticleController');

    $router->resource('nav', 'NavController');
    $router->resource('tag', 'TagController');
    $router->resource('type', 'TypeController');
    $router->resource('activity', 'ActivityController');
    $router->resource('raider', 'RaiderController');

    $router->resource('customized', 'CustomizedController');
    $router->resource('order', 'OrderController');
});
