<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Article;
use App\Models\Leader;
use App\Models\Raider;
use App\Models\Travel;
use App\Models\Video;
use Illuminate\Support\Facades\Cache;

class ShowController extends Controller
{
    // 显示活动
    public function activity(Activity $activity)
    {
        $data = Cache::remember("m-activity-{$activity->id}", 5, function () use ($activity) {
            $arr['activity'] = $activity->load('tags', 'types', 'tuans', 'trips', 'country', 'province', 'city', 'district');

            $arr['activities'] = Activity::with('types')
                ->active()
                ->where('id', '!=', $activity->id)
                ->where('province_id', $activity->province_id)
                ->limit(4)
                ->get(['id', 'title', 'short', 'thumb', 'price']);

            return $arr;
        });

        return view('m.activity', $data);
    }

    // 显示攻略
    public function raider(Raider $raider)
    {
        $raider->increment('click');
        $data = Cache::remember("m-raider-{$raider->id}", 5, function () use ($raider) {
            $arr['raider'] = $raider;
            $arr['activities'] = Activity::where('province_id', $raider->province_id)->active()->latest()->limit(4)->get(['id', 'title', 'thumb']);
            return $arr;
        });

        return view('m.raider', $data);
    }

    // 显示领队
    public function leader(Leader $leader)
    {
        $leader = Cache::remember("m-leader-{$leader->id}", 5, function () use ($leader) {
            return $leader->load(['activities' => function ($query) {
                $query->select('activities.id', 'title', 'thumb', 'price', 'description', 'province_id')
                    ->latest('activities.created_at')
                    ->active()
                    ->limit(4)
                    ->with('tags', 'province');
            }]);
        });
        return view('m.leader', compact('leader'));
    }

    // 显示游记
    public function travel(Travel $travel)
    {
        $travel->increment('click');
        $activities = Activity::active()->latest()->limit(3)->get(['id', 'title', 'thumb', 'description', 'price']);

        return view('m.travel', compact('travel', 'activities'));
    }

    // 显示视频
    public function video(Video $video)
    {
        $video->increment('click');
        if ($video->type === 'live') {
            return redirect($video->url);
        }

        $data = Cache::remember("m-video-{$video->id}", 5, function () use ($video) {
            $arr['video'] = $video;

            $arr['videos_count'] = $video->province->provinceVideos()->active()->type($video->type)->count();
            $arr['videos'] = $video->province->provinceVideos()->active()->type($video->type)->latest()->limit(3)->get(['id', 'thumb', 'title', 'description', 'type', 'province_id']);

            $arr['activities_count'] = $video->province->provinceActivities()->active()->count();
            $arr['activities'] = $video->province->provinceActivities()->active()->limit(3)->get(['id', 'title', 'thumb', 'price', 'description']);

            return $arr;
        });
        return view('m.video', $data);
    }

    // 显示文章
    public function article(Article $article)
    {
        return view('m.article', compact('article'));
    }
}
