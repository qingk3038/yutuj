<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    protected $casts = [
        'users' => 'object'
    ];

    public function tuan()
    {
        return $this->belongsTo(Tuan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function statusTest()
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

            default :
                return '未知状态';
        }
    }
}
