<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tuan extends Model
{
    protected $guarded = [];

    protected $dates = [
        'start_time', 'end_time'
    ];

    // 活动
    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }

    // 订单
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // 报名信息
    public function baomings()
    {
        return $this->hasManyThrough(Baoming::class, Order::class);
    }

    // 剩余名额
    public function remainder()
    {
        $ids = $this->orders()->whereIn('status', ['success', 'wait'])->pluck('id');
        $num = count($ids) ? Baoming::whereIn('order_id', $ids)->count() : 0;
        return $this->end_num - $this->start_num - $num;
    }

    // 是否可报名
    public function available()
    {
        $num = $this->remainder();
        $active = $this->activity->closed === 0;
        return $active && $num > 0 && today()->lte($this->end_time);
    }


}
