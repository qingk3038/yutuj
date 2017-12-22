<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Leader;
use App\Models\LocList;
use App\Models\Raider;
use App\Models\Travel;
use App\Models\Video;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

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
        $data = Cache::remember(request()->fullUrl(), 5, function () use ($request) {
            $this->validate($request, [
                'field' => 'nullable|in:id,click,created_at',
                'order' => 'nullable|in:asc,desc',
                'pid' => 'nullable|integer|exists:raiders,province_id',
                'cid' => 'nullable|integer|exists:raiders,city_id',
            ]);

            $field = $request->get('field', 'id');
            $order = $request->get('order', 'desc');

            $data['raiders'] = Raider::select('id', 'type', 'title', 'short', 'description', 'thumb', 'click', 'country_id', 'province_id', 'city_id', 'created_at')
                ->with('country', 'province', 'city')
                ->withCount('likes')
                ->orderBy($field, $order)
                ->type($request->type)
                ->where(function ($query) use ($request) {
                    if ($pid = $request->pid) {
                        $query->where('province_id', $pid);
                    }
                    if ($cid = $request->cid) {
                        $query->where('city_id', $cid);
                    }
                })->paginate();

            $data['provinces'] = LocList::whereHas('provinceRaiders', function ($query) use ($request) {
                $query->type($request->type);
            })->get(['id', 'name']);

            $data['cities'] = LocList::where(function ($query) use ($request) {
                if ($pid = $request->pid) {
                    $query->where('parent_id', $pid);
                }
            })->whereHas('cityRaiders', function ($query) use ($request) {
                $query->type($request->type);
            })->get(['id', 'name']);
            return $data;
        });
        return view('www.list_raider', $data);
    }

    /**
     * 活动列表
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function activity(Request $request)
    {
        $this->validate($request, [
            'field' => 'nullable|in:id,price,created_at',
            'order' => 'nullable|in:asc,desc',
            'pid' => 'nullable|integer|exists:activities,province_id',
            'cid' => 'nullable|integer|exists:activities,city_id',
            'price.min' => 'nullable|integer|min:0',
            'price.max' => 'nullable|integer|min:0',
        ]);
        $field = $request->get('field', 'id');
        $order = $request->get('order', 'desc');

        $data['activities'] = Activity::select('id', 'title', 'short', 'title', 'xc', 'description', 'thumb', 'price', 'province_id', 'city_id')
            ->active()->with(['tuans' => function ($query) {
                $query->where('end_time', '>=', Carbon::today());
            }])->where(function ($query) use ($request) {
                if ($pid = $request->pid) {
                    $query->where('province_id', $pid);
                }
                if ($cid = $request->cid) {
                    $query->where('city_id', $cid);
                }
                if ($min = $request->input('price.min')) {
                    $query->where('price', '>=', $min);
                }
                if ($max = $request->input('price.max')) {
                    $query->where('price', '<=', $max);
                }
            })->orderBy($field, $order)->paginate();

        $data['provinces'] = LocList::whereHas('provinceActivities', function ($query) {
            $query->active();
        })->get(['id', 'name']);

        $data['cities'] = LocList::where(function ($query) use ($request) {
            if ($pid = $request->pid) {
                $query->where('parent_id', $pid);
            }
        })->whereHas('cityActivities', function ($query) {
            $query->active();
        })->get(['id', 'name']);

        return view('www.list_activity', $data);
    }

    /**
     * 游记列表
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function travel(Request $request)
    {
        $data = Cache::remember(request()->fullUrl(), 5, function () use ($request) {
            $this->validate($request, [
                'field' => 'nullable|in:id,click,created_at',
                'order' => 'nullable|in:asc,desc',
                'province' => 'nullable|string|exists:travels',
                'city' => 'nullable|string|exists:travels',
            ]);

            $field = $request->get('field', 'id');
            $order = $request->get('order', 'desc');

            $data['travels'] = Travel::with('user')
                ->withCount('likes')
                ->orderBy($field, $order)
                ->status('adopt')
                ->where(function ($query) use ($request) {
                    if ($province = $request->province) {
                        $query->where('province', $province);
                    }
                    if ($city = $request->city) {
                        $query->where('city', $city);
                    }
                })->paginate();

            $data['provinces'] = Travel::status('adopt')->distinct()->get(['province as title']);
            $data['cities'] = Travel::status('adopt')->where(function ($query) use ($request) {
                if ($province = $request->province) {
                    $names = LocList::province()->where('name', $province)->first()->children->pluck('name');
                    $query->whereIn('city', $names);
                }
            })->distinct()->get(['city as title']);
            return $data;
        });
        return view('www.list_travels', $data);
    }

    public function video(Request $request)
    {
        $this->validate($request, [
            'film.field' => 'nullable|in:click,updated_at,created_at',
            'film.pid' => 'nullable|integer|exists:videos,province_id',

            'live.field' => 'nullable|in:click,updated_at,created_at',
            'live.pid' => 'nullable|integer|exists:videos,province_id',
        ]);

        $film_field = $request->input('film.field', 'click');
        $data['films'] = Video::active()->type('film')->where(function ($query) use ($request) {
            if ($pid = $request->input('film.pid')) {
                $query->where('province_id', $pid);
            }
        })->latest($film_field)->paginate(6);

        $live_field = $request->input('live.field', 'click');
        $data['lives'] = Video::active()->type('live')->where(function ($query) use ($request) {
            if ($pid = $request->input('live.pid')) {
                $query->where('province_id', $pid);
            }
        })->latest($live_field)->paginate(6);

        $data['provinces_films'] = LocList::whereHas('provinceVideos', function ($query) {
            $query->active()->type('film');
        })->get(['id', 'name']);

        $data['provinces_lives'] = LocList::whereHas('provinceVideos', function ($query) {
            $query->active()->type('live');
        })->get(['id', 'name']);

        return view('www.list_video', $data);
    }

}
