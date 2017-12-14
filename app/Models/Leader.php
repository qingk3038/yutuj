<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leader extends Model
{
    protected $casts = [
        'photos' => 'json',
    ];

    public function locList()
    {
        return $this->belongsTo(LocList::class, 'loc_id');
    }
}
