<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $casts = [
        'tese' => 'json',
        'feiyong' => 'json',
    ];

    // 标签
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    // 类别
    public function types()
    {
        return $this->belongsToMany(Type::class);
    }

    // 行程
    public function trips()
    {
        return $this->hasMany(Trip::class);
    }

    // 发团
    public function tuans()
    {
        return $this->hasMany(Tuan::class);
    }

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

}
