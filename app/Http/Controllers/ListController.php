<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Leader;
use App\Models\LocList;
use App\User;

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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function leaders()
    {
        $leaders = Leader::with('country', 'province', 'city')->latest('updated_at')->paginate();

        $provinces = LocList::province()->get(['id', 'name']);

        $activities = Activity::active()->limit(4)->get(['id', 'title', 'short', 'thumb', 'price']);

        return view('www.list_leader', compact('leaders', 'provinces', 'activities'));
    }
}
