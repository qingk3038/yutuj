<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\Category;
use App\Models\LocList;
use App\Models\Raider;
use App\Models\Travel;
use App\Models\Video;
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
                return LocList::whereHas('provinceActivities', function ($query) {
                    $query->active();
                })->orWhereHas('provinceRaiders')->orWhereHas('provinceVideos')->get(['id', 'name']);
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

        // 页面右边
        View::composer('www.right', function ($view) {
            $data = Cache::remember('right.blade', 5, function () use ($view) {
                $arr['raiders'] = Raider::latest()->limit(3)->get(['id', 'title', 'thumb', 'description']);
                $arr['raiders_count'] = Raider::count();

                $arr['film'] = Video::type('film')->latest()->first();
                $arr['film_count'] = Video::type('film')->count();

                $arr['live'] = Video::type('live')->latest()->first();
                $arr['live_count'] = Video::type('live')->count();

                $arr['travels'] = Travel::status('adopt')->latest()->limit(3)->get(['id', 'title', 'thumb', 'description']);
                $arr['travels_count'] = Travel::status('adopt')->count();
                return $arr;
            });
            $view->with($data);
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
