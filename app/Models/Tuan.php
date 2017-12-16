<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tuan extends Model
{
    protected $guarded = [];

    protected $dates = [
        'start_time', 'end_time'
    ];

    // 活动
    public function activities()
    {
        return $this->belongsToMany(Activity::class)->withTimestamps();
    }
}
