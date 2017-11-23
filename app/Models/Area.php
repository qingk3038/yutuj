<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $casts = [
        'hide' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('hide', 0);
    }

    public function citys()
    {
        return $this->hasMany(City::class);
    }
}
