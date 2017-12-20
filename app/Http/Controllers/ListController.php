<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Leader;
use App\Models\LocList;
use App\Models\Raider;
use App\User;
use Illuminate\Http\Request;
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function leaders(LocList $province = null)
    {
        $data = Cache::remember(request()->fullUrl(), 5, function () use ($province) {
            $data['leaders'] = $province ?
                $province->provinceLeaders()->select('id', 'name', 'avatar', 'brief', 'country_id', 'province_id', 'city_id')->latest('updated_at')->get()
                : Leader::select('id', 'name', 'avatar', 'brief', 'country_id', 'province_id', 'city_id')->with('country', 'province', 'city')->latest('updated_at')->get();

            $data['provinces'] = LocList::has('provinceLeaders')->get(['id', 'name']);

            $data['activities'] = Activity::active()->limit(4)->latest()->get(['id', 'title', 'short', 'thumb', 'price']);
            return $data;
        });

        return view('www.list_leader', $data)->with('province', $province);
    }

    /**
     * 攻略列表
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function raiders(Request $request)
    {
        $field = $request->get('field', 'id');
        $order = $request->get('order', 'desc');

        $data['raiders'] = Raider::select('id', 'type', 'title', 'short', 'description', 'thumb', 'click', 'country_id', 'province_id', 'city_id', 'created_at')
            ->with('country', 'province', 'city')
            ->withCount('likes')
            ->orderBy($field, $order)
            ->ctegory($request->type)
            ->where(function ($query) use ($request) {
                if ($pid = $request->pid) {
                    $query->where('province_id', $pid);
                }
                if ($cid = $request->cid) {
                    $query->where('city_id', $cid);
                }
            })->paginate();

        $data['provinces'] = LocList::whereHas('provinceRaiders', function ($query) use ($request) {
            $query->ctegory($request->type);
        })->get(['id', 'name']);

        $data['citys'] = LocList::where(function ($query) use ($request) {
            if ($pid = $request->pid) {
                $query->where('parent_id', $pid);
            }
        })->whereHas('cityRaiders', function ($query) use ($request) {
            $query->ctegory($request->type);
        })->get(['id', 'name']);

        return view('www.list_raider', $data);
    }
}
