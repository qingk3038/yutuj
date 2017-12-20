<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Leader;
use App\Models\Raider;
use App\Models\Travel;
use Illuminate\Support\Facades\Cache;

class ShowController extends Controller
{
    // 显示活动
    public function activity(Activity $activity)
    {
        $activities = Cache::remember(request()->fullUrl(), 5, function () use ($activity) {
            return Activity::with('types')
                ->active()
                ->where('id', '!=', $activity->id)
                ->where('province_id', $activity->province_id)
                ->limit(4)
                ->get(['id', 'title', 'short', 'thumb', 'price']);
        });
        return view('www.activity', compact('activity', 'activities'));
    }

    // 显示攻略
    public function raider(Raider $raider)
    {
        $raider->increment('click');
        return view('www.raider', compact('raider'));
    }

    // 显示领队
    public function leader(Leader $leader)
    {
        $leader = Cache::remember(request()->fullUrl(), 5, function () use ($leader) {
            return $leader->load( 'activities.types');
        });
        return view('www.leader', compact('leader'));
    }

    // 显示游记
    public function travel(Travel $travel)
    {
        $travel->increment('click');
        return view('www.travel', compact('travel'));
    }

}
