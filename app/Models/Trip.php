<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{

    protected $casts = [
        'photos' => 'array',
    ];

    // 活动
    public function activities()
    {
        return $this->belongsToMany(Activity::class);
    }
}
