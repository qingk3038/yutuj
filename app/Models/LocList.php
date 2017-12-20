<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocList extends Model
{
    protected $table = 'loclists';

    public $timestamps = false;

    // 国家
    public function scopeCountry()
    {
        return $this->where('type', 1);
    }

    // 省份
    public function scopeProvince()
    {
        return $this->where('type', 2);
    }

    // 城市
    public function scopeCity()
    {
        return $this->where('type', 3);
    }

    // 地区
    public function scopeDistrict()
    {
        return $this->where('type', 4);
    }

    // 父节点
    public function parent()
    {
        return $this->belongsTo(static::class, 'parent_id');
    }

    // 子节点
    public function children()
    {
        return $this->hasMany(static::class, 'parent_id');
    }

    // 兄弟节点
    public function brothers()
    {
        return $this->parent->children();
    }

    public static function options($id)
    {
        if (!$self = static::find($id)) {
            return [];
        }
        return $self->brothers()->pluck('name', 'id');
    }

    // 国家包含的活动
    public function countryActivities()
    {
        return $this->hasMany(Activity::class, 'country_id');
    }

    // 省份包含的活动
    public function provinceActivities()
    {
        return $this->hasMany(Activity::class, 'province_id');
    }

    // 城市包含的活动
    public function cityActivities()
    {
        return $this->hasMany(Activity::class, 'city_id');
    }

    // 地区包含的活动
    public function districtActivities()
    {
        return $this->hasMany(Activity::class, 'district_id');
    }

    // 省份领队
    public function provinceLeaders()
    {
        return $this->hasMany(Leader::class, 'province_id');
    }

    // 省份攻略
    public function provinceRaiders()
    {
        return $this->hasMany(Raider::class, 'province_id');
    }

    // 城市攻略
    public function cityRaiders()
    {
        return $this->hasMany(Raider::class, 'city_id');
    }
}
