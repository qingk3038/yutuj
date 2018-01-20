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

    // 实际已报名人数
    public function usersOkCount()
    {
        return $this->baomings()->where('orders.status', 'success')->count();
    }

    // 剩余名额
    public function remainder()
    {
        $num = $this->baomings()->whereIn('orders.status', ['success', 'wait'])->count();
        return $this->end_num - $this->start_num - $num;
    }

    // 是否可报名
    public function available()
    {
        return
            $this->activity->closed === 0
            && $this->remainder() > 0
            && today()->lte($this->end_time);
    }

}
