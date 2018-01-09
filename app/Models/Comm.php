<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comm extends Model
{
    public function comm()
    {
        return $this->morphTo();
    }
}
