<?php

namespace App\Models;

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
}
