<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Facades\Agent;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
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
     * 找回密码下一步
     * @param string $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function showResetForm(string $token)
    {
        $obj = DB::table('password_resets')->where('token', $token)->first();
        if ($obj === null) {
            return redirect()->route('password.request');
        }
        $append = Agent::ismobile() ? 'm' : 'www';
        return view($append . '.auth.passwords.reset', compact('token'));
    }

    public function reset(Request $request)
    {
        $this->validate($request, [
            'token' => 'required|string|exists:password_resets',
            'password' => 'required|string|min:6|confirmed',
        ]);
        $obj = DB::table('password_resets')->where('token', $request->token)->first();
        $user = User::where('mobile', $obj->mobile)->first();
        DB::table('password_resets')->where('token', $obj->token)->delete();
        if (empty($user)) {
            return response(['message' => '手机未注册。'], 404);
        }
        $this->resetPassword($user, $request->password);
        $path = session()->pull('url.intended', $this->redirectTo);
        return ['url' => $path];
    }
}
