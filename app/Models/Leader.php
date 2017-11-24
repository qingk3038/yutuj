<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leader extends Model
{
    protected $casts = [
        'hide' => 'boolean',
        'photos' => 'array'
    ];

    public function scopeActive($query)
    {
        return $query->where('hide', 0);
    }
}
