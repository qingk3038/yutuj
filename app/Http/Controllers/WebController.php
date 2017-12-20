<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Leader;
use App\Models\LocList;
use App\Models\Nav;
use App\Models\Raider;
use App\Models\Travel;
use Illuminate\Support\Facades\Cache;

class WebController extends Controller
{
    public function index()
    {
        $indexs = Cache::remember('index', 5, function () {
            // 搜索栏下面 导航切换
            $arr['nav_tabs'] = Nav::with(['activities' => function ($query) {
                $query->select('id', 'title', 'short', 'thumb')->active()->limit(4)->latest('updated_at');
            }])->get(['id', 'text']);

            // 热门线路
            $arr['host_lines'] = Activity::limit(4)->latest('updated_at')->get(['id', 'title', 'short', 'thumb']);

            // 搜索栏显示省份
            $arr['provinces'] = LocList::has('provinceActivities')->get(['id', 'name']);

            // 攻略-玩
            $arr['wans'] = Raider::type()->limit(6)->latest('updated_at')->get(['id', 'title', 'short', 'thumb']);

            // 攻略-酒店
            $arr['hospitals'] = Raider::type('hospital')->limit(6)->latest('updated_at')->get(['id', 'title', 'short', 'thumb']);

            // 领队
            $arr['leaders'] = Leader::limit(3)->latest('updated_at')->get(['id', 'name', 'avatar']);

            // 游记
            $arr['travels'] = Travel::with('user')->where('status', 'adopt')->latest('updated_at')->limit(6)->get(['id', 'title', 'thumb', 'description', 'created_at', 'user_id']);

            return $arr;
        });

        return view('www.index', $indexs);
    }

}
