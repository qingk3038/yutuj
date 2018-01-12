<?php

namespace App\Http\Controllers\Mobile;

use App\Events\OrderPay;
use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Order;
use App\Models\Tuan;
use EasyWeChat\Payment\Application;

class PayController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('wechatNotice', 'alipayNotice', 'alipayReturn');
    }

    // 填写报名信息
    public function create(Tuan $tuan)
    {
        $tuan->load('activity');
        return view('m.pay.order', compact('tuan'));
    }

    // Wap支付和显示支付结果
    public function showQrcode(Application $app, Order $order)
    {
        // 下单状态
        if ($order->status === 'wait') {
            $out_trade_no = date('Ymd') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
            $order->out_trade_no = $out_trade_no;
            $order->save();

            if ($order->type === 'alipay') {
                $total_fee = env('APP_DEBUG') ? 0.01 : $order->money / 100;
                $alipay = app('alipay.wap');
                $alipay->setOutTradeNo($order->out_trade_no);
                $alipay->setTotalFee($total_fee);
                $alipay->setSubject('遇途记-活动报名缴费');
                $alipay->setBody(str_limit($order->tuan->activity->title));
                return redirect()->to($alipay->getPayLink());
            } else {
                $total_fee = env('APP_DEBUG') ? 1 : $order->money;
                $attributes = [
                    'body' => '遇途记-活动报名缴费',
                    'out_trade_no' => $order->out_trade_no,
                    'total_fee' => $total_fee,
                    'trade_type' => 'MWEB',
                    'notify_url' => env('WECHAT_NOTIFY_URL')
                ];
                $result = $app->order->unify($attributes);
                return redirect()->to($result['mweb_url']);
            }
        }

        $activity = $order->tuan->activity;
        $activities = Activity::where('province_id', $activity->province_id)->active()->latest()->limit(4)->get(['id', 'title', 'thumb']);

        // 结果状态
        return view('m.pay.result', compact('order', 'activities'));
    }
}
