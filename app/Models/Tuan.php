<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tuan extends Model
{
    // 活动
    public function activities()
    {
        return $this->belongsToMany(Activity::class);
    }
}
