<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');

    $router->any('/upload/images', 'HomeController@images');

    $router->resource('web/lanmu', 'LanmuController');
    $router->resource('web/article', 'ArticleController');

    $router->resource('yunying/area', 'AreaController');
    $router->resource('yunying/city', 'CityController');

});
