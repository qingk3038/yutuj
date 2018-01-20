<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Leader;
use App\Models\Nav;
use App\Models\Raider;
use App\Models\Video;
use Illuminate\Support\Facades\Cache;

class WebController extends Controller
{
    // 首页数据
    public function index()
    {
        $data = Cache::remember('m-index' . request()->fullUrl(), 5, function () {
            $arr['hots'] = Nav::findOrFail(1)->activities()->active()->latest()->limit(6)->get(['id', 'title', 'short', 'thumb', 'price']);
            $arr['wans'] = Raider::type('default')->latest()->limit(6)->get(['id', 'title', 'short', 'thumb']);
            $arr['hospitals'] = Raider::type('hospital')->latest()->limit(6)->get(['id', 'title', 'short', 'thumb']);
            $arr['leaders'] = Leader::latest()->limit(6)->get(['id', 'name', 'avatar', 'brief']);
            $arr['films'] = Video::type('film')->active()->limit(6)->get();
            $arr['lives'] = Video::type('live')->active()->limit(6)->get();
            $arr['navs'] = $navs = Nav::where('id', '>', 1)->limit(4)->get(['id', 'text']);
            $arr['activities'] = Activity::with('province')
                ->whereHas('navs', function ($query) use ($navs) {
                    $nid = request('nid') ?: array_first($navs)->id;
                    $query->where('id', $nid);
                })
                ->active()
                ->latest()
                ->paginate(null, ['id', 'title', 'short', 'thumb', 'price', 'province_id']);
            return $arr;
        });
        return view('m.index', $data);
    }

}
