<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $casts = [
        'hide' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('hide', 0);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }
}
