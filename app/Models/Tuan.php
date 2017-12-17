<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Tuan extends Model
{
    protected $guarded = [];

    protected $dates = [
        'start_time', 'end_time'
    ];

    // 活动
    public function activities()
    {
        return $this->belongsToMany(Activity::class)->withTimestamps();
    }

    // 订单
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // 剩余名额
    public function remainder()
    {
        $num = $this->orders()->whereIn('status', ['success', 'wait'])->count();
        return $this->end_num - $this->start_num - $num;
    }

    // 是否可报名
    public function available()
    {
        $num = $this->remainder();
        return $num > 0 && Carbon::today()->lte($this->end_time);
    }
}
