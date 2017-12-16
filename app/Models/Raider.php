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

    // 作者
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
}
