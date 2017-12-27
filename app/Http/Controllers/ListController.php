<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Leader;
use App\Models\LocList;
use App\Models\Nav;
use App\Models\Raider;
use App\Models\Travel;
use App\Models\Video;
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
            $arr['leaders'] = $province ?
                $province->provinceLeaders()->select('id', 'name', 'avatar', 'brief', 'country_id', 'province_id', 'city_id')->latest('updated_at')->get()
                : Leader::with('country', 'province', 'city')->latest('updated_at')->get(['id', 'name', 'avatar', 'brief', 'country_id', 'province_id', 'city_id']);

            $arr['provinces'] = LocList::has('provinceLeaders')->get(['id', 'name']);

            $arr['activities'] = Activity::active()->limit(4)->latest()->get(['id', 'title', 'short', 'thumb', 'price']);
            return $arr;
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

            $arr['raiders'] = Raider::with('country', 'province', 'city')
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
                })->paginate(10, ['id', 'type', 'title', 'short', 'description', 'thumb', 'click', 'country_id', 'province_id', 'city_id', 'created_at']);

            $arr['provinces'] = LocList::whereHas('provinceRaiders', function ($query) use ($request) {
                $query->type($request->type);
            })->get(['id', 'name']);

            $arr['cities'] = LocList::where(function ($query) use ($request) {
                if ($pid = $request->pid) {
                    $query->where('parent_id', $pid);
                }
            })->whereHas('cityRaiders', function ($query) use ($request) {
                $query->type($request->type);
            })->get(['id', 'name']);
            return $arr;
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
        $data = Cache::remember(request()->fullUrl(), 5, function () use ($request) {
            $this->validate($request, [
                'field' => 'nullable|in:id,price,created_at',
                'order' => 'nullable|in:asc,desc',
                'pid' => 'nullable|integer|exists:activities,province_id',
                'cid' => 'nullable|integer|exists:activities,city_id',
                'nid' => 'nullable|integer|exists:navs,id',
                'price.min' => 'nullable|integer|min:0',
                'price.max' => 'nullable|integer|min:0',
            ]);
            $field = $request->get('field', 'id');
            $order = $request->get('order', 'desc');

            $arr['activities'] = Activity::active()->with('tuans')->withCount('trips')
                ->where(function ($query) use ($request) {
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
                    if ($nid = $request->nid) {
                        $query->whereHas('navs', function ($query) use ($nid) {
                            $query->where('id', $nid);
                        });
                    }
                })->orderBy($field, $order)->paginate(10, ['id', 'title', 'short', 'title', 'xc', 'description', 'thumb', 'price', 'province_id', 'city_id']);

            $arr['provinces'] = LocList::whereHas('provinceActivities', function ($query) use ($request) {
                $query->active();
                if ($nid = $request->nid) {
                    $query->whereHas('navs', function ($query) use ($nid) {
                        $query->where('id', $nid);
                    });
                }
            })->get(['id', 'name']);

            $arr['cities'] = LocList::where(function ($query) use ($request) {
                if ($pid = $request->pid) {
                    $query->where('parent_id', $pid);
                }
            })->whereHas('cityActivities', function ($query) use ($request) {
                $query->active();
                if ($nid = $request->nid) {
                    $query->whereHas('navs', function ($query) use ($nid) {
                        $query->where('id', $nid);
                    });
                }
            })->get(['id', 'name']);

            $arr['nav'] = Nav::find($request->nid);

            return $arr;
        });

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

            $arr['travels'] = Travel::status('adopt')
                ->with('user')
                ->withCount('likes')
                ->orderBy($field, $order)
                ->where(function ($query) use ($request) {
                    if ($province = $request->province) {
                        $query->where('province', $province);
                    }
                    if ($city = $request->city) {
                        $query->where('city', $city);
                    }
                })->paginate();

            $arr['provinces'] = Travel::status('adopt')->distinct()->get(['province as title']);
            $arr['cities'] = Travel::status('adopt')->where(function ($query) use ($request) {
                if ($province = $request->province) {
                    $names = LocList::province()->where('name', $province)->first()->children->pluck('name');
                    $query->whereIn('city', $names);
                }
            })->distinct()->get(['city as title']);
            return $arr;
        });
        return view('www.list_travels', $data);
    }

    /**
     * 视频列表
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function video(Request $request)
    {
        $data = Cache::remember(request()->fullUrl(), 5, function () use ($request) {
            $this->validate($request, [
                '*.field' => 'nullable|in:click,updated_at,created_at',
                '*.pid' => 'nullable|integer|exists:videos,province_id',
            ]);

            $film_field = $request->input('film.field', 'click');
            $arr['films'] = Video::active()->type('film')->where(function ($query) use ($request) {
                if ($pid = $request->input('film.pid')) {
                    $query->where('province_id', $pid);
                }
            })->latest($film_field)->paginate(6);

            $live_field = $request->input('live.field', 'click');
            $arr['lives'] = Video::active()->type('live')->where(function ($query) use ($request) {
                if ($pid = $request->input('live.pid')) {
                    $query->where('province_id', $pid);
                }
            })->latest($live_field)->paginate(6);

            $arr['provinces_films'] = LocList::whereHas('provinceVideos', function ($query) {
                $query->active()->type('film');
            })->get(['id', 'name']);

            $arr['provinces_lives'] = LocList::whereHas('provinceVideos', function ($query) {
                $query->active()->type('live');
            })->get(['id', 'name']);
            return $arr;
        });
        return view('www.list_video', $data);
    }

    // 搜索页面
    public function search(Request $request)
    {
        $keyword = $request->get('q');
        if (!$keyword) {
            return redirect('/');
        }
        $data = Cache::remember(request()->fullUrl(), 5, function () use ($keyword) {

            $arr['navs'] = Nav::get(['id', 'text']);
            foreach ($arr['navs'] as $nav) {
                // 活动
                $nav->activities = $nav->activities()
                    ->active()
                    ->latest()
                    ->with('tuans')
                    ->withCount('trips')
                    ->whereRaw('match (title, description) against(?)', $keyword)
                    ->paginate(5, ['id', 'title', 'short', 'title', 'xc', 'description', 'thumb', 'price', 'province_id'], 'a_page');
            }

            $arr['raider_types'] = ['default' => '攻略', 'line' => '线路', 'scenic' => '景点', 'food' => '美食', 'hospital' => '民宿'];

            // 攻略
            foreach ($arr['raider_types'] as $key => $type) {
                $arr['raiders'][$key] = Raider::where('type', $key)
                    ->latest()
                    ->with('country', 'province', 'city')
                    ->withCount('likes')
                    ->whereRaw('match (title, description) against(?)', $keyword)
                    ->paginate(5, ['id', 'type', 'title', 'short', 'description', 'thumb', 'click', 'created_at'], 'r_page');
            }

            // 游记
            $arr['travels'] = Travel::status('adopt')
                ->with('user')
                ->withCount('likes')
                ->latest()
                ->whereRaw('match (title, description) against(?)', $keyword)
                ->paginate(5, ['id', 'title', 'description', 'thumb'], 't_page');

            // 视频
            $arr['films'] = Video::active()->type('film')->whereRaw('match (title, description) against(?)', $keyword)->latest()->paginate(5, ['*'], 'f_page');
            $arr['lives'] = Video::active()->type('live')->whereRaw('match (title, description) against(?)', $keyword)->latest()->paginate(5, ['*'], 'l_page');

            return $arr;
        });

        return view('www.search', $data);
    }

}
