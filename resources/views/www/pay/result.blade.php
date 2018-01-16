@extends('layouts.app')

@section('title', '报名流程-第3步：订单结果')

@section('content')
    <div class="container-fluid bg-warning">
        <h3 class="text-white text-center" style="padding-top: 160px; padding-bottom: 100px;">
            {{ $order->statusText() }}
        </h3>
    </div>
    <div class="container" id="app">
        <div class="bg-white px-5 py-2" style="margin-top: -80px;">
            <div class="text-center">
                @if($order->status === 'success')
                    <img src="{{ asset('img/step_pay_3_success.png') }}" alt="支付成功">
                @else
                    <img src="{{ asset('img/step_pay_3_error.png') }}" alt="支付失败">
                @endif
            </div>
            <hr class="mt-1 mb-5">
            @if($order->status === 'success')
                <div class="m-auto w-50">
                    <h2 class="text-success"><i class="fa fa-fw fa-3x fa-smile-o align-middle" style="margin-left: -124px"></i>{{ $order->statusText() }}！祝您出行愉快！</h2>
                    <p>
                        支付金额：<span class="text-danger">￥{{ number_format($order->total_fee / 100, 2) }}</span>
                        <br>交易号：{{ $order->transaction_id  }}
                        <br>产品名称：{{ $order->tuan->activity->title }}
                    </p>
                    <p><a href="{{ route('activity.show', $order->tuan->activity)  }}" class="btn btn-warning text-white btn-sm">返回活动</a></p>
                    <p><a href="{{ route('home.order')  }}" class="text-warning d-block"><i class="fa fa-fw fa-angle-double-right"></i>点击进入“我的订单”</a></p>
                </div>
            @else
                <div class="m-auto w-50">
                    <h2 class="text-danger"><i class="fa fa-fw fa-3x fa-meh-o align-middle" style="margin-left: -124px"></i>{{ $order->statusText() }}！</h2>
                    <p>
                        <span class="text-danger">需要重新下单，才能再次支付。</span>
                        <br>订单号：{{ $order->out_trade_no  }}
                        <br>产品名称：{{ $order->tuan->activity->title }}
                    </p>
                    <p><a href="{{ route('activity.show', $order->tuan->activity)  }}" class="btn btn-warning text-white btn-sm">返回活动</a></p>
                    <p><a href="{{ route('home.order')  }}" class="text-warning d-block"><i class="fa fa-fw fa-angle-double-right"></i>点击进入“我的订单”</a></p>
                </div>
            @endif
        </div>
    </div>
@endsection