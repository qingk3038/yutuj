<?php

namespace App\Models;

use Encore\Admin\Auth\Database\Administrator;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    // 作者
    public function admin()
    {
        return $this->belongsTo(Administrator::class, 'admin_user_id');
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

    // 激活状态
    public function scopeActive($query)
    {
        return $query->where('closed', 0);
    }

    // 类别
    public function scopeType($query, $type = null)
    {
        if (!in_array($type, ['live', 'film'])) {
            return $query;
        }
        return $query->where('type', $type);
    }
}
