<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * 显示登陆界面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('www.auth.login');
    }

    /**
     * 认证字段
     * @return string
     */
    public function username()
    {
        return 'mobile';
    }

    /**
     * 认证后
     * @param Request $request
     * @param $user
     * @return array
     */
    protected function authenticated(Request $request, $user)
    {
        $path = session()->pull('url.intended', $this->redirectTo);
        return ['url' => $path];
    }

    /**
     * 自定义认证
     * @param Request $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            array_merge($this->credentials($request), ['disable' => 0]), $request->filled('remember')
        );
    }
}
