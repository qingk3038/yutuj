<?php

namespace App;

use App\Models\Follow;
use App\Models\Travel;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'mobile', 'password', 'sex', 'province', 'city', 'birthday', 'description', 'avatar', 'bg_home'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'birthday' => 'date'
    ];

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
     */
    public function fans()
    {
        return $this->hasMany(Follow::class, 'gz_id');
    }

}
