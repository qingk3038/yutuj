<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{
    protected $fillable = [
        'title', 'thumb', 'description', 'body', 'province', 'city', 'click', 'status', 'user_id'
    ];

    /**
     * 游记状态
     * @param $query
     * @param $status
     * @return mixed
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * 游记作者
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 喜欢游记的用户
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function likes()
    {
        return $this->morphToMany(User::class, 'like');
    }
}
