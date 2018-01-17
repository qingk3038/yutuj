<?php

namespace App\Listeners;

use App\Models\Sms;
use Overtrue\EasySms\EasySms;

class UserEventSubscriber
{
    /**
     * 为订阅者注册监听器。
     */
    public function subscribe($events)
    {
        $events->listen(
            'Illuminate\Auth\Events\Login',
            'App\Listeners\UserEventSubscriber@onUserLogin'
        );

        $events->listen(
            'Illuminate\Auth\Events\Logout',
            'App\Listeners\UserEventSubscriber@onUserLogout'
        );

        $events->listen(
            'Illuminate\Auth\Events\Registered',
            'App\Listeners\UserEventSubscriber@onUserRegistered'
        );

        $events->listen(
            'App\Events\OrderPay',
            'App\Listeners\UserEventSubscriber@onUserPay'
        );
    }

    /**
     * 处理用户登录事件。
     */
    public function onUserLogin($event)
    {
        //
    }

    /**
     * 处理用户注销事件。
     */
    public function onUserLogout($event)
    {
        //
    }

    /**
     * 处理用户注册事件。
     */
    public function onUserRegistered($event)
    {
        $user = $event->user;
        $user->messages()->create(['type' => 'master', 'title' => '管理员给我发来了站内通知', 'body' => '“欢迎加入遇途记，有您的相伴，是我们最大的荣幸！” ']);
    }

    /**
     * 处理用户支付事件。
     */
    public function onUserPay($event)
    {
        $order = $event->order;
        $author = $order->author;
        $author->messages()->create([
            'type' => 'sys', 'title' => '系统通知',
            'body' => sprintf(
                '用户%s你好，<br>你的订单%s支付%s了！<a href="%s" target="_blank">点击查看详情>></a> ',
                $author->name ?? $author->mobile, $order->out_trade_no, $order->status === 'success' ? '成功' : '失败', route('home.order.show', $order)
            ),
        ]);
        if ($order->status === 'success') {
            $user = $order->baomings()->first();
            $message = ['template' => config('sms_pay'), 'data' => ['userNick' => $user->name, 'activityNcik' => $order->tuan->activity->title, 'adTime' => $order->tuan->start_time->toDateString()]];
            $easySms = new EasySms(config('sms'));
            $res = $easySms->send($user->mobile, $message);
            Sms::create(['mobile' => $user->mobile, 'vars' => $message, 'result' => $res, 'op' => 'pay']);
        }
    }
}