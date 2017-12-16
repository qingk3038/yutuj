<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $guarded = [];

    protected $casts = [
        'pictures' => 'array',
    ];

    // 活动
    public function activities()
    {
        return $this->belongsToMany(Activity::class)->withTimestamps();
    }
}
