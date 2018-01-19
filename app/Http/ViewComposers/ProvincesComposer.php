<?php

namespace App\Http\ViewComposers;

use App\Models\LocList;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class ProvincesComposer
{
    public function __construct()
    {
        //
    }

    /**
     * 搜索栏 筛选地区
     *
     * @param  View $view
     * @return void
     */
    public function compose(View $view)
    {
        $searchProvinces = Cache::remember('searchProvinces', 5, function () {
            return LocList::whereHas('provinceActivities', function ($query) {
                $query->active();
            })->orWhereHas('provinceRaiders')->orWhereHas('provinceVideos')->limit(10)->get(['id', 'name']);
        });
        $view->with('searchProvinces', $searchProvinces);
    }
}