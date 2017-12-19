<?php

namespace App;

use App\Models\Follow;
use App\Models\Raider;
use App\Models\Travel;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'mobile', 'password', 'sex', 'province', 'city', 'birthday', 'description', 'avatar', 'bg_home', 'api_token', 'disable'
    ];

    protected $hidden = [
        'password', 'remember_token', 'api_token'
    ];

    /**
     * 获取背景图片
     * @param $bg_home
     * @return string
     */
    protected function getBgHomeAttribute($bg_home)
    {
        return $bg_home && Storage::exists($bg_home) ? Storage::url($bg_home) : asset('img/bg_home.jpg');
    }

    /**
     * 获取头像
     * @param $avatar
     * @return string
     */
    protected function getAvatarAttribute($avatar)
    {
        return $avatar && Storage::exists($avatar) ? Storage::url($avatar) : asset('img/user_avatar.png');
    }


    /**
     * 游记
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function travels()
    {
        return $this->hasMany(Travel::class);
    }

    /**
     * 关注
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function follows()
    {
        return $this->hasMany(Follow::class);
    }

    /**
     * 粉丝
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fans()
    {
        return $this->hasMany(Follow::class, 'gz_id');
    }

    /**
     * 会员喜欢的游记
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function likeTravels()
    {
        return $this->morphedByMany(Travel::class, 'like');
    }

    /**
     * 会员喜欢的攻略
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function likeRaiders()
    {
        return $this->morphedByMany(Raider::class, 'like');
    }
}
