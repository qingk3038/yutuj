<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Rules\Code;
use App\Rules\Mobile;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

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

    /**
     * 找回密码页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLinkRequestForm()
    {
        return view('www.auth.passwords.forgot');
    }

    public function mobile(Request $request)
    {
        $this->validate($request, [
            'mobile' => ['required', 'string', new Mobile()],
            'code' => ['required', 'string', 'min:4', new Code('forgot')],
        ]);
        $token = str_random(60);
        DB::table('password_resets')->insert([
            'mobile' => $request->mobile,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);
        return ['token' => $token];
    }
}
