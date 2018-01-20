<?php

namespace App\Providers;

use App\Http\ViewComposers\ProvincesComposer;
use App\Http\ViewComposers\WebFooterComposer;
use App\Http\ViewComposers\WebRightComposer;
use Encore\Admin\Config\Config;
use Illuminate\Support\Carbon;
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
//        Schema::defaultStringLength(250);

        // 加载配置
        Config::load();

        // 搜索栏筛选地区
        View::composer(['layouts.app', 'www.index', 'm.provinces'], ProvincesComposer::class);
        // 底部栏目与文章
        View::composer('layouts.app', WebFooterComposer::class);
        // 页面右边
        View::composer('www.right', WebRightComposer::class);
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
