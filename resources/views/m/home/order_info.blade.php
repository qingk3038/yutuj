@extends('layouts.m')

@section('title', '我的订单')

@section('header')
    @include('m.header', ['title' => '订单详情'])
@endsection

@section('content')
    <div class="container-fluid mt-5 py-3">
        <h6 class="left-border-orange text-truncate">{{ $order->tuan->activity->title }}</h6>
        <small class="pl-3">订单号：{{ $order->out_trade_no }} </small>
    </div>
    <div class="container-fluid top-border p-3 small">
        产品类型：{{ $order->tuan->activity->types->pluck('text')->implode('、') }} <br>
        游玩天数：{{ $order->tuan->activity->trips->count() }}天 <br>
        发团日期：每月多团<br>
        出发地点：{{ $order->tuan->activity->cfd }} <br>
        活动批次：{{ $order->tuan->start_time->toDateString() }} - {{ $order->tuan->end_time->toDateString() }}
    </div>
    <div class="container-fluid top-border p-3 small">
        @foreach($order->baomings as $baoming)
            <h6>报名人{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</h6>
            姓名：{{ $baoming->name }} <br>
            证件类型：{{ $baoming->typeText() }} <br>
            证件号：{{ $baoming->cardID }} <br>
            联系电话：{{ $baoming->mobile }} <br>
            紧急联系人：{{ $baoming->nameJ }} <br>
            急联系人电话：{{ $baoming->mobileJ }}
            @if($loop->remaining)
                <hr>
            @endif
        @endforeach
    </div>
    <div class="container-fluid top-border p-3 small">
        总人数：{{ count($order->baomings) }}人 <br>
        总金额：<span class="text-danger">¥{{ $order->tuan->price * count($order->baomings) }}元</span> <br>
        订单状态：{{ $order->statusText() }}
        @if($order->status === 'wait')
            <a href="{{ route('order.qrcode', $order) }}" target="_blank" class="text-warning text-white">去支付</a>
        @endif
    </div>
@endsection

@section('footer', false)
