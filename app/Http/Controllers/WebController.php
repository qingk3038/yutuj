<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Leader;
use App\Models\Nav;
use App\Models\Raider;
use App\Models\Travel;
use App\Models\Video;
use EasyWeChat\OfficialAccount\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class WebController extends Controller
{
    public function index()
    {
        $data = Cache::remember('index', 5, function () {
            // 搜索栏下面 导航切换
            $arr['nav_tabs'] = Nav::with(['activities' => function ($query) {
                $query->select('id', 'title', 'short', 'thumb')->active()->limit(4)->latest('updated_at');
            }])->get(['id', 'text']);

            // 热门线路
            $arr['host_lines'] = Activity::limit(4)->latest('updated_at')->get(['id', 'title', 'short', 'thumb']);

            // 攻略-游玩
            $arr['wans'] = Raider::type('default')->limit(6)->latest('updated_at')->get(['id', 'title', 'short', 'thumb']);

            // 攻略-酒店
            $arr['hospitals'] = Raider::type('hospital')->limit(6)->latest('updated_at')->get(['id', 'title', 'short', 'thumb']);

            // 领队
            $arr['leaders'] = Leader::limit(3)->latest('updated_at')->get(['id', 'name', 'avatar']);

            // 游记
            $arr['travels'] = Travel::with('user')->where('status', 'adopt')->latest('updated_at')->limit(6)->get(['id', 'title', 'thumb', 'description', 'created_at', 'user_id']);

            // 视频
            $arr['lives'] = Video::type('live')->active()->limit(3)->get();
            $arr['films'] = Video::type('film')->active()->limit(3)->get();

            // 视频右边 攻略
            $arr['z_wans'] = Raider::type('default')->limit(5)->latest()->get(['id', 'title', 'short', 'thumb']);
            $arr['z_lines'] = Raider::type('line')->limit(5)->latest()->get(['id', 'title', 'short', 'thumb']);
            $arr['z_scenics'] = Raider::type('scenic')->limit(5)->latest()->get(['id', 'title', 'short', 'thumb']);
            $arr['z_foods'] = Raider::type('food')->limit(5)->latest()->get(['id', 'title', 'short', 'thumb']);
            $arr['z_hospitals'] = Raider::type('hospital')->limit(5)->latest()->get(['id', 'title', 'short', 'thumb']);
            return $arr;
        });
        return view('www.index', $data);
    }

    // 微信和QQ
    public function login(Application $app, Request $request)
    {
        $driver = $request->get('driver', 'wechat');
        if ($driver === 'wechat') {
            // 微信登录
            return $app->oauth->scopes(['snsapi_login'])->redirect();
        }

        return 'QQ登录页面';
    }

    public function wechatCallback()
    {
        return '微信登录的回调页面';
    }

    public function qqCallback()
    {
        return 'QQ登录的回调页面';
    }
}
