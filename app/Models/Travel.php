<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{
    protected $fillable = [
        'title', 'thumb', 'body', 'province', 'city', 'click', 'user_id'
    ];
}
