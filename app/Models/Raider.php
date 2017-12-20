<?php

namespace App\Models;

use App\User;
use Encore\Admin\Auth\Database\Administrator;
use Illuminate\Database\Eloquent\Model;

class Raider extends Model
{
    /**
     * 导航
     */
    public function navs()
    {
        return $this->morphToMany(Nav::class, 'comm');
    }

    /**
     * 作者
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function admin()
    {
        return $this->belongsTo(Administrator::class, 'admin_user_id');
    }

    /**
     * 喜欢攻略的用户
     */
    public function likes()
    {
        return $this->morphToMany(User::class, 'like');
    }

    /**
     * 类别
     * @param $query
     * @param string $type
     * @return mixed
     */
    public function scopeType($query, $type = 'default')
    {
        return $query->where('type', $type);
    }

    /**
     * 攻略类别
     * @return string
     */
    public function typeText()
    {
        switch ($this->type) {
            case 'line':
                $type = '线路';
                break;
            case 'food':
                $type = '美食';
                break;
            case 'hospital':
                $type = '住宿';
                break;
            case 'scenic':
                $type = '景点';
                break;
            default:
                $type = '玩法';
        }
        return $type;
    }
}
