<?php

namespace App\Http\Controllers;

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
        $data = Cache::remember(request()->fullUrl(), 5, function () use ($activity) {
            $arr['activity'] = $activity->load('tags', 'types', 'tuans', 'trips', 'country', 'province', 'city', 'district');

            $arr['activities'] = Activity::with('types')
                ->active()
                ->where('id', '!=', $activity->id)
                ->where('province_id', $activity->province_id)
                ->limit(4)
                ->get(['id', 'title', 'short', 'thumb', 'price']);

            return $arr;
        });

        return view('www.activity', $data);
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
            return $leader->load('activities.types');
        });
        return view('www.leader', compact('leader'));
    }

    // 显示游记
    public function travel(Travel $travel)
    {
        $travel->increment('click');
        $activities = Activity::active()->latest()->limit(3)->get(['id', 'title', 'thumb', 'description', 'price']);

        return view('www.travel', compact('travel', 'activities'));
    }

    // 显示视频
    public function video(Video $video)
    {
        abort_if($video->closed, 404);

        $video->increment('click');
        if ($video->type === 'live') {
            return redirect($video->url);
        }

        $data = Cache::remember(request()->fullUrl(), 5, function () use ($video) {
            $arr['videos_count'] = $video->province->provinceVideos()->active()->type($video->type)->count();
            $arr['videos'] = $video->province->provinceVideos()->active()->type($video->type)->latest()->limit(3)->get(['id', 'thumb', 'title', 'description', 'type', 'province_id']);

            $arr['activities_count'] = $video->province->provinceActivities()->active()->count();
            $arr['activities'] = $video->province->provinceActivities()->active()->limit(3)->get(['id', 'title', 'thumb', 'price', 'description']);

            return $arr;
        });
        return view('www.video', $data)->with('video', $video);
    }

    // 显示文章
    public function article(Article $article)
    {
        return view('www.article', compact('article'));
    }
}
