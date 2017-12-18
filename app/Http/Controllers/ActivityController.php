<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ActivityController extends Controller
{
    public function show(Activity $activity, Request $request)
    {
        $fullUrl = $request->fullUrl();
        $like_activities = Cache::remember($fullUrl, 30, function () use ($activity) {
            return Activity::with('types')
                ->where('id', '!=', $activity->id)
                ->where('province_id', $activity->province_id)
                ->limit(4)
                ->get(['id', 'title', 'short', 'thumb', 'price']);
        });
        return view('www.activity', compact('activity', 'like_activities'));
    }

}
