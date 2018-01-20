<?php

namespace App\Http\ViewComposers;

use App\Models\Raider;
use App\Models\Travel;
use App\Models\Video;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class WebRightComposer
{
    public function __construct()
    {
        //
    }

    /**
     * 页面右边
     *
     * @param  View $view
     * @return void
     */
    public function compose(View $view)
    {
        $data = Cache::remember('webRight', 5, function () use ($view) {
            $arr['raiders'] = Raider::latest()->limit(3)->get(['id', 'title', 'thumb', 'description']);
            $arr['raiders_count'] = Raider::count();

            $arr['film'] = Video::type('film')->latest()->first();
            $arr['film_count'] = Video::type('film')->count();

            $arr['live'] = Video::type('live')->latest()->first();
            $arr['live_count'] = Video::type('live')->count();

            $arr['travels'] = Travel::status('adopt')->latest()->limit(3)->get(['id', 'title', 'thumb', 'description']);
            $arr['travels_count'] = Travel::status('adopt')->count();
            return $arr;
        });
        $view->with($data);
    }
}