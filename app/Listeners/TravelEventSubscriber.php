<?php

namespace App\Listeners;

use App\User;

class TravelEventSubscriber
{
    /**
     * 为订阅者注册监听器。
     */
    public function subscribe($events)
    {
        $events->listen(
            'app\Events\TravelAudit',
            'App\Listeners\TravelEventSubscriber@onTravelAudit'
        );
    }

    /**
     * 处理游记审核通过事件
     * @param $event
     */
    public function onTravelAudit($event)
    {
        $travel = $event->travel;
        $user = User::find($travel->user_id);

        $user->messages()->create([
            'title' => '系统通知',
            'body' => sprintf(
                '亲爱的%s：你的游记《%s》已经成功发表，可以招呼亲朋好友们一起来欣赏你的大作啦~<a href="%s" target="_blank">点击查看游记>></a> ',
                $user->name ?? $user->mobile,
                $travel->title,
                route('home.travel.show', $travel)
            ),
            'read' => 0
        ]);

    }

}