<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');

    $router->resource('web/lanmu', 'LanmuController');
    $router->resource('web/article', 'ArticleController');

    $router->resource('yunying/area', 'AreaController');
    $router->resource('yunying/city', 'CityController');
    $router->resource('yunying/leader', 'LeaderController');


    $router->post('upload/images', 'HomeController@images');
    $router->get('api/areas', 'AreaController@search');
});
