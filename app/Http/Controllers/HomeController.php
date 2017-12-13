<?php

namespace App\Http\Controllers;

use App\Models\Travel;
use App\Rules\Code;
use App\Rules\Mobile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('www.home.setting');
    }

    /**
     * 更新主页背景图片
     * @param Request $request
     * @return array
     */
    public function backgroundImage(Request $request)
    {
        $this->validate($request, [
            'bg' => 'required|file'
        ]);
        $path = $request->file('bg')->store('bg');
        $user = $request->user();
        $user->bg_home = $path;
        $user->save();

        return ['path' => Storage::url($path), 'message' => '主页背景已更新。'];
    }

    /**
     * 更新头像
     * @param Request $request
     * @return array
     */
    public function uploadAvatar(Request $request)
    {
        $this->validate($request, [
            'avatar' => 'required|file'
        ]);
        $path = $request->file('avatar')->store('avatar');
        $user = $request->user();
        $user->avatar = $path;
        $user->save();

        return ['path' => Storage::url($path), 'message' => '头像已更新。'];
    }

    /**
     * 更新个人资料
     * @param Request $request
     * @return array
     */
    public function update(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required|string|between:3,20',
            'sex' => 'required|string|in:F,M',
            'province' => 'nullable|string',
            'city' => 'nullable|string',
            'birthday' => 'required|date',
            'description' => 'required|string|between:3,250',
        ]);
        $request->user()->update($data);
        return ['message' => '个人资料已更新。'];
    }

    /**
     * 更新个人密码
     * @param Request $request
     * @return array
     */
    public function updatePwd(Request $request)
    {
        $this->validate($request, [
            'code' => ['bail', 'required', 'string', 'min:4', new Code('forgot')],
            'password' => 'required|string|confirmed|min:6',
        ]);

        $request->user()->password = bcrypt($request->password);
        $request->user()->save();
        return ['message' => '个人密码已更新。'];
    }

    /**
     * 绑定手机号
     * @param Request $request
     * @return array
     */
    public function updateMobile(Request $request)
    {
        $this->validate($request, [
            'oldTel' => ['required', 'string', new Mobile(), 'exists:users,mobile'],
            'newTel' => ['required', 'string', new Mobile(), 'unique:users,mobile'],
            'code' => ['bail', 'required', 'string', 'min:4', new Code('update')],
        ]);

        $request->user()->mobile = $request->newTel;
        $request->user()->save();
        return ['message' => '绑定手机已更新。'];
    }
}
