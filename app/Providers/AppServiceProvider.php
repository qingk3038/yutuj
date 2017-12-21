<?php

namespace App\Providers;

use App\Models\LocList;
use Encore\Admin\Config\Config;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Carbon::setLocale('zh');
        Schema::defaultStringLength(250);

       // 加载配置
        Config::load();

        // 搜索栏 筛选地区
        View::composer(['layouts.app', 'www.index'], function ($view) {
            $searchProvinces = Cache::remember('searchProvinces', 5, function () {
                return LocList::has('provinceActivities')->get(['id', 'name']);
            });
            $view->with('searchProvinces', $searchProvinces);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
