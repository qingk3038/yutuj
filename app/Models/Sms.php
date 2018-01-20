<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sms extends Model
{
    protected $fillable = [
        'mobile', 'vars', 'result', 'op'
    ];
    protected $casts = [
        'vars' => 'array',
        'result' => 'object',
    ];
}