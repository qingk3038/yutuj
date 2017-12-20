<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Leader;
use App\Models\LocList;
use App\User;
use Illuminate\Support\Facades\Cache;

class ListController extends Controller
{

    /**
     * 会员的游记列表
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function userTravel(User $user)
    {
        $travels = $user->travels()->withCount('likes')->latest('updated_at')->paginate();

        return view('www.user_travels', compact('user', 'travels'));
    }

    /**
     * 领队列表
     * @param LocList|null $province
     * @return $this
     */
    public function leaders(LocList $province = null)
    {
        $data = Cache::remember(request()->fullUrl(), 5, function () use ($province) {
            $data['leaders'] = $province ?
                $province->provinceLeaders()->select('id', 'name', 'avatar', 'brief', 'country_id', 'province_id', 'city_id')->latest('updated_at')->paginate()
                : Leader::select('id', 'name', 'avatar', 'brief', 'country_id', 'province_id', 'city_id')->with('country', 'province', 'city')->latest('updated_at')->paginate();

            $data['provinces'] = LocList::has('provinceLeaders')->get(['id', 'name']);

            $data['activities'] = Activity::active()->limit(4)->latest()->get(['id', 'title', 'short', 'thumb', 'price']);
            return $data;
        });

        return view('www.list_leader', $data)->with('province', $province);
    }
}
