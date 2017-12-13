<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');

    $router->post('/upload/images', 'HomeController@images');
    $router->resource('/web/user', 'UserController');
    $router->resource('/web/travel', 'TravelController');
});
