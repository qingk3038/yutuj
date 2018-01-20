<?php

namespace App\Http\Controllers\Auth;

use App\Rules\Code;
use App\Rules\Mobile;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Jenssegers\Agent\Facades\Agent;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'mobile' => ['required', 'string', new Mobile(), 'unique:users'],
            'password' => 'required|string|min:6',
            'code' => ['bail', 'required', 'string', 'min:4', new Code('register')],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'mobile' => $data['mobile'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * 注册页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        $append = Agent::isMobile() ? 'm' : 'www';
        return view($append . '.auth.register');
    }

    /**
     * 注册完成
     * @param Request $request
     * @param $user
     * @return array
     */
    protected function registered(Request $request, $user)
    {
        $path = session()->pull('url.intended', $this->redirectTo);
        return ['url' => $path];
    }
}
