<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    public function tuan()
    {
        return $this->belongsTo(Tuan::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function baomings()
    {
        return $this->hasMany(Baoming::class);
    }

    public function money()
    {
        return $this->tuan->price * $this->baomings()->count();
    }

    public function statusText()
    {
        switch ($this->status) {
            case 'close':
                return '订单关闭';
                break;

            case 'wait':
                return '等待支付';
                break;

            case 'fail':
                return '支付失败';
                break;

            case 'success':
                return '支付成功';
                break;

            case 'cancel':
                return '退款';
                break;

            default :
                return '未知状态';
        }
    }
}
