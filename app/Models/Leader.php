<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leader extends Model
{
    protected $casts = [
        'photos' => 'json',
    ];

    public function country()
    {
        return $this->belongsTo(LocList::class, 'country_id');
    }

    public function province()
    {
        return $this->belongsTo(LocList::class, 'province_id');
    }

    public function city()
    {
        return $this->belongsTo(LocList::class, 'city_id');
    }

    public function district()
    {
        return $this->belongsTo(LocList::class, 'district_id');
    }
}
