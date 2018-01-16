<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Rules\Code;
use App\Rules\Mobile;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Facades\Agent;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showLinkRequestForm()
    {
        $append = Agent::isMobile() ? 'm' : 'www';
        return view($append . '.auth.passwords.forgot');
    }

    public function mobile(Request $request)
    {
        $this->validate($request, [
            'mobile' => ['required', 'string', new Mobile(), 'exists:users'],
            'code' => ['required', 'string', 'min:4', new Code('forgot')],
        ]);
        $token = str_random(60);
        DB::table('password_resets')->insert([
            'mobile' => $request->mobile,
            'token' => $token,
            'created_at' => now()
        ]);
        return ['token' => $token];
    }
}
