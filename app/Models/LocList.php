<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocList extends Model
{
    protected $table = 'loclists';

    public $timestamps = false;


    public function scopeCountry()
    {
        return $this->where('type', 1);
    }

    public function scopeProvince()
    {
        return $this->where('type', 2);
    }

    public function scopeCity()
    {
        return $this->where('type', 3);
    }

    public function scopeDistrict()
    {
        return $this->where('type', 4);
    }

    public function parent()
    {
        return $this->belongsTo(static::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(static::class, 'parent_id');
    }

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

    /**
     * 国家包含的活动
     */
    public function countryActivities()
    {
        return $this->hasMany(Activity::class, 'country_id');
    }

    /**
     * 省份包含的活动
     */
    public function provinceActivities()
    {
        return $this->hasMany(Activity::class, 'province_id');
    }

    /**
     * 城市包含的活动
     */
    public function cityActivities()
    {
        return $this->hasMany(Activity::class, 'city_id');
    }

    /**
     * 地区包含的活动
     */
    public function districtActivities()
    {
        return $this->hasMany(Activity::class, 'district_id');
    }
}
