<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leader extends Model
{
    protected $casts = [
        'photos' => 'array',
    ];

    // 国家
    public function country()
    {
        return $this->belongsTo(LocList::class, 'country_id');
    }

    // 省份
    public function province()
    {
        return $this->belongsTo(LocList::class, 'province_id');
    }

    // 城市
    public function city()
    {
        return $this->belongsTo(LocList::class, 'city_id');
    }

    // 地区
    public function district()
    {
        return $this->belongsTo(LocList::class, 'district_id');
    }

    // 活动
    public function activities()
    {
        return $this->belongsToMany(Activity::class)->withTimestamps();
    }
}
