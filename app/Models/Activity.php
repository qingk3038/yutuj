<?php

namespace App\Models;

use Encore\Admin\Auth\Database\Administrator;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $casts = [
        'photos' => 'array',
        'tps' => 'array',
    ];

    // 作者
    public function admin()
    {
        return $this->belongsTo(Administrator::class, 'admin_user_id');
    }

    // 标签
    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    // 类别
    public function types()
    {
        return $this->belongsToMany(Type::class)->withTimestamps();
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

    // 导航
    public function navs()
    {
        return $this->morphToMany(Nav::class, 'comm');
    }

    // 领队
    public function leaders(){
        return $this->belongsToMany(Leader::class)->withTimestamps();
    }

}
