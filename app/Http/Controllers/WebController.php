<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Leader;
use App\Models\LocList;
use App\Models\Nav;
use App\Models\Raider;
use Illuminate\Support\Facades\Cache;

class WebController extends Controller
{
    public function index()
    {
        // 搜索栏下面 导航切换
        $nav_tabs = Cache::remember('index_nav', 5, function () {
            return Nav::with(['activities' => function ($query) {
                $query->select('id', 'title', 'short', 'thumb')->limit(4)->latest('updated_at');
            }])->get(['id', 'text']);
        });

        // 热门线路
        $host_lines = Cache::remember('index_host_lines', 5, function () {
            return Activity::limit(4)->latest('updated_at')->get(['id', 'title', 'short', 'thumb']);
        });

        // 搜索栏显示省份
        $provinces = Cache::remember('province', 5, function () {
            return LocList::has('provinceActivities')->get(['id', 'name']);
        });

        // 攻略-玩
        $wans = Cache::remember('index_wans', 5, function () {
            return Raider::type()->limit(6)->latest('updated_at')->get(['id', 'title', 'short', 'thumb']);
        });

        // 攻略-酒店
        $hospitals = Cache::remember('index_hospitals', 5, function () {
            return Raider::type('hospital')->limit(6)->latest('updated_at')->get(['id', 'title', 'short', 'thumb']);
        });

        $leaders =  Cache::remember('index_leaders', 5, function () {
            return Leader::limit(3)->latest('updated_at')->get(['id', 'name', 'avatar']);
        });
        return view('www.index', compact('nav_tabs', 'host_lines', 'provinces', 'wans', 'hospitals', 'leaders'));
    }

}
