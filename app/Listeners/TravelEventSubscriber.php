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
            'App\Events\TravelStatusChange',
            'App\Listeners\TravelEventSubscriber@onTravelStatusChange'
        );
    }

    /**
     * 所有状态改变
     * @param $event
     */
    public function onTravelStatusChange($event)
    {
        $travel = $event->travel;
        if ($travel->status === 'adopt') {
            $this->onTravelAudit($travel);
        }
        if ($travel->status === 'reject') {
            $this->onTravelReject($travel);
        }
    }

    /**
     * 处理游记审核通过事件
     * @param $travel
     */
    protected function onTravelAudit($travel)
    {
        $user = User::find($travel->user_id);
        $user->messages()->create([
            'type' => 'sys',
            'title' => '系统通知',
            'body' => sprintf(
                '亲爱的%s：<br>你的游记《%s》已经成功发表，可以招呼亲朋好友们一起来欣赏你的大作啦~<a href="%s" target="_blank">点击查看游记>></a> ',
                $user->name ?? $user->mobile, $travel->title, route('home.travel.show', $travel)
            ),
        ]);
    }

    /**
     * 处理游记审核拒绝事件
     * @param $travel
     */
    protected function onTravelReject($travel)
    {
        $user = User::find($travel->user_id);
        $user->messages()->create([
            'type' => 'sys',
            'title' => '系统通知',
            'body' => sprintf(
                '亲爱的%s：<br>你的游记《%s》被管理员拒绝发表，你可以更改后再次提交~<a href="%s" target="_blank">点击查看游记>></a> ',
                $user->name ?? $user->mobile, $travel->title, route('home.travel.show', $travel)
            ),
        ]);
    }

}