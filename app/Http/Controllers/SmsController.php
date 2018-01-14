<?php

namespace App\Http\Controllers;

use App\Models\Sms;
use App\Rules\Mobile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Overtrue\EasySms\EasySms;

class SmsController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request, [
            'mobile' => ['required', new Mobile(), 'unique:users']
        ]);
        return $this->sendSmsCode(config('sms_register'), $request->mobile, __FUNCTION__);
    }

    public function forgot(Request $request)
    {
        if (auth()->check()) {
            return $this->sendSmsCode(config('sms_forgot'), auth()->user()->mobile, __FUNCTION__);
        }
        $this->validateMobile($request);
        return $this->sendSmsCode(config('sms_forgot'), $request->mobile, __FUNCTION__);
    }

    public function update(Request $request)
    {
        if (auth()->check()) {
            return $this->sendSmsCode(config('sms_update'), auth()->user()->mobile, __FUNCTION__);
        }
        $this->validateMobile($request);
        return $this->sendSmsCode(config('sms_update'), $request->mobile, __FUNCTION__);
    }

    private function sendSmsCode($template, $mobile, $op)
    {
        if (Cache::has('sms_cannot_send')) {
            return response(['errors' => ['message' => '发送过于频繁，请稍后再试。']], 422);
        }

        if ($sms_max = (int)config('sms_max')) {
            $num = Sms::where('mobile', $mobile)->whereDate('created_at', Carbon::today())->count();
            if ($num >= $sms_max) {
                return response(['errors' => ['message' => '今天短信发送次数过多，请明天再试。']], 422);
            }
        }

        $code = random_int(10000, 99999);
        $message = ['template' => $template, 'data' => ['code' => $code]];

        if (env('APP_DEBUG')) {
            session()->put($op, $code);
            Cache::put('sms_cannot_send', true, 1);
            Sms::create(['mobile' => $mobile, 'vars' => $message, 'result' => 'debug', 'op' => $op]);
            return ['message' => '短信发送成功。'];
        }

        try {
            $easySms = new EasySms(config('sms'));
            $res = $easySms->send($mobile, $message);
            Sms::create(['mobile' => $mobile, 'vars' => $message, 'result' => $res, 'op' => $op]);
            $arr = head($res);
            if ($arr['status'] === 'success') {
                session()->put($op, $code);
                Cache::put('sms_cannot_send', true, 1);
                return ['message' => '短信发送成功。'];
            }
        } catch (\Exception $exception) {
            return response(['message' => '短信发送失败。'], 422);
        }
    }

    private function validateMobile(Request $request)
    {
        $this->validate($request, [
            'mobile' => ['required', new Mobile(), 'exists:users']
        ]);
    }
}