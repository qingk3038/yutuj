<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Leader;
use App\Models\Nav;
use App\Models\Raider;
use App\Models\Travel;
use App\Models\Video;
use EasyWeChat\OfficialAccount\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Jenssegers\Agent\Facades\Agent;

class WebController extends Controller
{
    public function index()
    {
        $data = Cache::remember('index', 5, function () {
            $arr['nav_tabs'] = $navs = Nav::get(['id', 'text']);
            foreach ($navs as $nav) {
                $nav->load(['activities' => function ($query) {
                    $query->select('id', 'title', 'short', 'thumb')->active()->latest('updated_at')->limit(4);
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
        // 微信内置浏览器使用公众号登录
        if (strpos(Agent::getUserAgent(), 'MicroMessenger') !== false) {
            return $app->oauth->scopes(['snsapi_userinfo'])->redirect();
        }
        // 其余浏览器使用开放平台登录
        return $app->oauth->scopes(['snsapi_login'])
            ->with(['appid' => config('wechat.open.app_id')])
            ->redirect(config('wechat.open.redirect'));
    }

    // 微信开放平台登录回调
    public function callbackWechatOpen()
    {
        $config = [
            'wechat' => [
                'client_id' => config('wechat.open.app_id'),
                'client_secret' => config('wechat.open.secret'),
                'redirect' => config('wechat.open.redirect'),
            ],
        ];
        $socialite = new \Overtrue\Socialite\SocialiteManager($config);
        $user = $socialite->driver('wechat')->user();

        return wechatLogin($user);
    }

    // 微信公众号登录回调
    public function callbackWechat()
    {
        $user = session('wechat.oauth_user.default');
        return wechatLogin($user);
    }

    /**
     * 文章编辑器上传图片
     * @param Request $request
     * @return array
     */
    public function uploadImages(Request $request)
    {
        if (!Auth::check() && !Auth::guard('admin')->check()) {
            return ['errno' => 1, 'message' => '未认证。'];
        }
        $validator = Validator::make($request->all(), [
            'files' => 'required|array',
            'files.*' => 'image',
        ]);

        if ($validator->fails()) {
            return ['errno' => 1, 'message' => $validator->errors()];
        }

        $files = $request->file('files');

        $data = [];
        foreach ($files as $file) {
            $path = $file->store('images');
            $data[] = Storage::url($path);
        }
        return ['errno' => 0, 'data' => $data];
    }
}
