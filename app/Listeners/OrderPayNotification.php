<?php

namespace App\Listeners;

use App\Events\OrderPay;
use App\Models\Sms;
use Overtrue\EasySms\EasySms;

class OrderPayNotification
{

    public function __construct()
    {
        //
    }

    public function handle(OrderPay $event)
    {
        $order = $event->order;
        $user = $order->baomings()->first();
        $easySms = new EasySms(config('sms'));
        $message = ['template' => config('sms_pay'), 'data' => ['userNick' => $user->name, 'activityNcik' => $order->tuan->activity->title, 'adTime' => $order->tuan->start_time->toDateString()]];
        $res = $easySms->send($user->mobile, $message);
        Sms::create(['mobile' => $user->mobile, 'vars' => $message, 'result' => $res, 'op' => 'pay']);
    }
}
