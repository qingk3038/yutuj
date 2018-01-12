<?php

namespace App\Http\Controllers;

use App\Events\OrderPay;
use App\Models\Baoming;
use App\Models\Order;
use App\Models\Tuan;
use App\Rules\Mobile;
use EasyWeChat\Payment\Application;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PayController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('create', 'wechatNotice', 'alipayNotice', 'alipayReturn');
    }

    // 填写报名信息
    public function create(Tuan $tuan)
    {
        $tuan->load('activity');
        return view('www.pay.order', compact('tuan'));
    }

    // 提交报名信息
    public function store(Tuan $tuan, Request $request)
    {
        $data = $this->validate($request, [
            'users.*.name' => 'required|distinct|between:2,10',
            'users.*.mobile' => ['required', 'distinct', new Mobile],
            'users.*.cardType' => 'required|in:ID,officer,passport',
            'users.*.cardID' => 'required|distinct',
            'users.*.nameJ' => 'required|between:2,10',
            'users.*.mobileJ' => ['required', new Mobile],
            'remarks' => 'nullable',
            'type' => 'required|in:alipay,wechat',
        ], [], [
            'users.*.name' => '用户名',
            'users.*.mobile' => '手机号',
            'users.*.cardType' => '证件类型',
            'users.*.cardID' => '证件号码',
            'users.*.nameJ' => '紧急联系人',
            'users.*.mobileJ' => '紧急联系人手机号',
        ]);

        if (!$tuan->available()) {
            return response(['errors' => ['message' => '本活动已满员或已结束。']], 422);
        }

        $baomings = [];
        foreach ($data['users'] as $user) {
            $baomings[] = new Baoming($user);
        }

        $order = new Order(array_merge($request->only('remarks', 'type'), ['status' => 'wait', 'user_id' => auth()->id()]));
        $tuan->orders()->save($order);
        $order->baomings()->saveMany($baomings);
        return ['message' => '订单已生成，请前往页面支付。', 'path' => route('order.qrcode', $order)];
    }

    // 显示二维码的支付页面和支付结果
    public function showQrcode(Order $order)
    {
        // 下单状态
        if ($order->status === 'wait') {
            return view('www.pay.qrcode', compact('order'));
        }

        // 结果状态
        return view('www.pay.result', compact('order'));
    }

    // 微信 - 生成二维码
    public function wechat(Application $app, Order $order)
    {
        $total_fee = env('APP_DEBUG') ? 1 : $order->money() * 100;
        $out_trade_no = date('Ymd') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
        $attributes = [
            'body' => '遇途记-活动报名缴费',
            'out_trade_no' => $out_trade_no,
            'total_fee' => $total_fee,
            'trade_type' => 'NATIVE',
        ];

        $result = $app->order->unify($attributes);
        if ($result['return_code'] === 'SUCCESS') {
            $order->out_trade_no = $out_trade_no;
            $order->total_fee = $total_fee;
            $order->save();

            return QrCode::format('png')->size(268)->margin(0)->generate($result['code_url']);
        } else {
            return QrCode::format('png')->encoding('UTF-8')->size(268)->margin(0)->generate('当前二维码有误，请使用支付宝付款。');
        }
    }

    // 查询订单状态
    public function orderStatus(Request $request, Order $order)
    {
        abort_unless($request->user()->id === $order->user_id, 404);
        return ['status' => $order->status];
    }

    // 微信异步通知
    public function wechatNotice(Application $app)
    {
        return $app->handlePaidNotify(function ($message, $fail) {
            $order = Order::where('out_trade_no', $message['out_trade_no'])->latest()->first();
            if (!$order) {
                $fail('Order not exist.');
            }
            if ($order->pay_at) {
                return true;
            }
            if ($message['result_code'] === 'SUCCESS') {
                $order->status = 'success';
                try {
                    event(new OrderPay($order));
                } catch (\Exception $exception) {
                    \Log::error('异步通知 微信支付错误', $exception);
                }
            } else {
                $order->status = 'fail';
            }
            $order->type = 'wechat';
            $order->total_fee = $message['total_fee'];
            $order->transaction_id = $message['transaction_id'];
            $order->pay_at = now();
            $order->save();

            return true;
        });
    }

    // 创建支付宝订单
    public function alipay(Order $order)
    {
        $total_fee = env('APP_DEBUG') ? 0.01 : $order->money();
        $out_trade_no = date('Ymd') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);

        $alipay = app('alipay.web');
        $alipay->setOutTradeNo($out_trade_no);
        $alipay->setTotalFee($total_fee);
        $alipay->setSubject('遇途记-活动报名缴费');
        $alipay->setBody(str_limit($order->tuan->activity->title, 60));
        $alipay->setQrPayMode('4'); // 二维码样式

        $order->out_trade_no = $out_trade_no;
        $order->save();
        return redirect($alipay->getPayLink());
    }

    // 转跳支付宝官网支付
    public function alipayWeb(Order $order)
    {
        $total_fee = env('APP_DEBUG') ? 0.01 : $order->money();
        $out_trade_no = date('Ymd') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);

        $alipay = app('alipay.web');
        $alipay->setOutTradeNo($out_trade_no);
        $alipay->setTotalFee($total_fee);
        $alipay->setSubject('遇途记-活动报名缴费');
        $alipay->setBody(str_limit($order->tuan->activity->title, 60));

        $order->out_trade_no = $out_trade_no;
        $order->save();

        return redirect($alipay->getPayLink());
    }

    // 支付宝异步通知
    public function alipayNotice(Request $request)
    {
        if (!app('alipay.web')->verify()) {
            return 'fail';
        }
        $order = Order::where('out_trade_no', $request->get('out_trade_no'))->latest()->first();
        if (!$order) {
            return 'Order not exist.';
        }

        if ($order->pay_at) {
            return 'success';
        }

        $trade_status = $request->get('trade_status');
        if ($trade_status === 'TRADE_SUCCESS') {
            $order->status = 'success';
            try {
                event(new OrderPay($order));
            } catch (\Exception $exception) {
                \Log::error('异步通知 支付宝支付错误', $exception);
            }
        } else {
            $order->status = 'fail';
        }

        $order->type = 'alipay';
        $order->total_fee = $request->get('total_fee') * 100;
        $order->transaction_id = $request->get('trade_no');
        $order->pay_at = now();
        $order->save();

        return 'success';
    }

    // 支付宝同步支付
    public function alipayReturn(Request $request)
    {
        if (!app('alipay.web')->verify()) {
            return redirect('/');
        }
        $order = Order::where('out_trade_no', $request->out_trade_no)->latest()->first();
        if (!$order) {
            return 'Order not exist.';
        }
        return redirect()->route('order.qrcode', $order);
    }

}
