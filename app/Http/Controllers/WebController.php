<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Leader;
use App\Models\Nav;
use App\Models\Raider;
use App\Models\Travel;
use App\Models\Video;
use App\User;
use EasyWeChat\OfficialAccount\Application;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Cache;
use Jenssegers\Agent\Facades\Agent;

class WebController extends Controller
{
    public function index()
    {
        $data = Cache::remember('index', 1, function () {
            $arr['nav_tabs'] = $navs = Nav::get(['id', 'text']);
            foreach ($navs as $nav) {
                $nav->load(['activities' => function ($query) {
                    $query->select('id', 'title', 'short', 'thumb')->active()->latest()->limit(4);
                }]);
            }

            // 热门线路
            $arr['host_lines'] = Activity::limit(4)->latest('updated_at')->get(['id', 'title', 'short', 'thumb']);
            // 攻略-游玩
            $arr['wans'] = Raider::type('default')->limit(6)->latest('updated_at')->get(['id', 'title', 'short', 'thumb']);
            // 攻略-酒店
            $arr['hospitals'] = Raider::type('hospital')->limit(6)->latest('updated_at')->get(['id', 'title', 'short', 'thumb']);
            // 领队
            $arr['leaders'] = Leader::limit(3)->latest('updated_at')->get(['id', 'name', 'avatar']);
            // 游记
            $arr['travels'] = Travel::with('user')->where('status', 'adopt')->latest('updated_at')->limit(6)->get(['id', 'title', 'thumb', 'description', 'created_at', 'user_id']);
            // 视频
            $arr['lives'] = Video::type('live')->active()->limit(3)->get();
            $arr['films'] = Video::type('film')->active()->limit(3)->get();
            // 视频右边 攻略
            $arr['z_wans'] = Raider::type('default')->limit(5)->latest()->get(['id', 'title', 'short', 'thumb']);
            $arr['z_lines'] = Raider::type('line')->limit(5)->latest()->get(['id', 'title', 'short', 'thumb']);
            $arr['z_scenics'] = Raider::type('scenic')->limit(5)->latest()->get(['id', 'title', 'short', 'thumb']);
            $arr['z_foods'] = Raider::type('food')->limit(5)->latest()->get(['id', 'title', 'short', 'thumb']);
            $arr['z_hospitals'] = Raider::type('hospital')->limit(5)->latest()->get(['id', 'title', 'short', 'thumb']);
            return $arr;
        });
        return view('www.index', $data);
    }

    // 微信登录
    public function loginWechat(Application $app)
    {
        if (strpos(Agent::getUserAgent(), 'MicroMessenger') !== false) {
            return $app->oauth->scopes(['snsapi_userinfo'])->redirect();
        }
        // snsapi_login
        return $app->oauth->scopes(['snsapi_login'])->redirect();
    }

    // 微信登录回调
    public function callbackWechat()
    {
        $user = session('wechat.oauth_user.default');
        if (!$wx_user = User::where('wx_id', $user->getId())->first()) {
            $wx_user = User::create([
                'wx_id' => $user->getId(),
                'email' => $user->getEmail(),
                'name' => $user->getNickname(),
                'password' => bcrypt(str_random(6)),
                'sex' => array_get($user->getOriginal(), 'sex') === 1 ? 'M' : 'F',
                'province' => array_get($user->getOriginal(), 'province'),
                'city' => array_get($user->getOriginal(), 'city'),
                'avatar' => $user->getAvatar()
            ]);
            event(new Registered($wx_user));
        }

        // 禁止登陆
        abort_if($wx_user->disable, 403);

        auth()->login($wx_user);
        return redirect()->intended('/home');
    }

    // QQ登录
    public function loginQQ()
    {
        return 'QQ登录';;
    }

    public function callbackQQ()
    {
        return 'QQ登录的回调页面';
    }
}
