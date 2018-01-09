<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\Leader;
use App\Models\Nav;
use App\Models\Raider;
use App\Models\Video;

class MController extends Controller
{
    // 首页数据
    public function index()
    {
        $data['line_activities'] = Nav::findOrFail(1)->activities()->active()->latest()->limit(6)->get(['id', 'title', 'short', 'thumb', 'price']);

        $data['wans'] = Raider::type('default')->latest()->limit(6)->get(['id', 'title', 'short', 'thumb']);

        $data['hospitals'] = Raider::type('hospital')->latest()->limit(6)->get(['id', 'title', 'short', 'thumb']);

        $data['leaders'] = Leader::latest()->limit(6)->get(['id', 'name', 'avatar', 'brief']);


        $data['films'] = Video::type('film')->active()->limit(6)->get();
        $data['lives'] = Video::type('live')->active()->limit(6)->get();

        $data['navs'] = Nav::where('id', '>', 1)->limit(4)->get(['id', 'text']);

        return view('m.index', $data);
    }


    // 导航的活动加载
    public function loadActivities(Nav $nav)
    {
        return $nav->activities()->with('province')->active()->latest()->paginate(null, ['id', 'title', 'short', 'thumb', 'price', 'province_id']);
    }
}
