<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nav extends Model
{
    public function activities()
    {
        return $this->morphedByMany(Activity::class, 'comm');
    }
}
