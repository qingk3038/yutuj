<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\Category;
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

        // 底部栏目与文章
        View::composer('layouts.app', function ($view) {
            $categories = Cache::remember('footer', 5, function () {
                return Category::with(['articles' => function ($query) {
                    $query->select('id', 'title', 'category_id')->limit(5);
                }])->where('parent_id', 0)->offset(1)->limit(4)->get(['id', 'title']);
            });
            $abouts = Cache::remember('abouts', 5, function () {
                return Article::where('category_id', 1)->get(['id', 'title']);
            });
            $view->with(compact('categories', 'abouts'));
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
