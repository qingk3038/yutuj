<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Leader;
use App\Models\Nav;
use App\Models\Raider;
use App\Models\Video;

class WebController extends Controller
{
    // 首页数据
    public function index()
    {
        $data['hots'] = Nav::findOrFail(1)->activities()->active()->latest()->limit(6)->get(['id', 'title', 'short', 'thumb', 'price']);

        $data['wans'] = Raider::type('default')->latest()->limit(6)->get(['id', 'title', 'short', 'thumb']);

        $data['hospitals'] = Raider::type('hospital')->latest()->limit(6)->get(['id', 'title', 'short', 'thumb']);

        $data['leaders'] = Leader::latest()->limit(6)->get(['id', 'name', 'avatar', 'brief']);

        $data['films'] = Video::type('film')->active()->limit(6)->get();
        $data['lives'] = Video::type('live')->active()->limit(6)->get();

        $data['navs'] = $navs = Nav::where('id', '>', 1)->limit(4)->get(['id', 'text']);

        $data['activities'] = Activity::with('province')
            ->whereHas('navs', function ($query) use ($navs) {
                $nid = request('nid') ?: array_first($navs)->id;
                $query->where('id', $nid);
            })
            ->active()
            ->latest()
            ->paginate(1, ['id', 'title', 'short', 'thumb', 'price', 'province_id']);
        return view('m.index', $data);
    }

}
