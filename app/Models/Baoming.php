<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Baoming extends Model
{
    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function typeText()
    {
        switch ($this->cardType) {
            case 'ID':
                return '身份证';
                break;

            case 'officer':
                return '军官证';
                break;

            case 'passport':
                return '护照';
                break;

            default :
                return '未知';
                break;
        }
    }
}
