<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Leader;
use App\Models\Raider;
use Illuminate\Support\Facades\Cache;

class ShowController extends Controller
{
    // 显示活动
    public function showActivity(Activity $activity)
    {
        $like_activities = Cache::remember(request()->fullUrl(), 5, function () use ($activity) {
            return Activity::with('types')
                ->where('id', '!=', $activity->id)
                ->where('province_id', $activity->province_id)
                ->limit(4)
                ->get(['id', 'title', 'short', 'thumb', 'price']);
        });
        return view('www.activity', compact('activity', 'like_activities'));
    }

    // 显示攻略
    public function showRaider(Raider $raider)
    {
        return view('www.raider', compact('raider'));
    }

    // 显示领队
    public function showLeader(Leader $leader)
    {
        $leader = Cache::remember(request()->fullUrl(), 5, function () use ($leader) {
            return $leader->load('activities', 'activities.types');
        });
        return view('www.leader', compact('leader'));
    }

}
