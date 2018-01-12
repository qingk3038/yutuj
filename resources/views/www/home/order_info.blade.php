@extends('layouts.home')

@section('body')
    <h5 class="px-3 pt-3 m-0">订单详情</h5>
    <hr>
    <ul class="px-4 list-unstyled order-info">
        <li>
            <p>产品编号：{{ $order->tuan->activity->number }}</p>
            <h5 class="text-truncate">{{ $order->tuan->activity->title }}</h5>
        </li>
        <li>
            产品类型：{{ $order->tuan->activity->types->pluck('text')->implode('、') }}
            <br>游玩天数：{{ $order->tuan->activity->trips->count() }}天
            <br>发团日期：每月多团
            <br>出发地点：{{ $order->tuan->activity->cfd }}
            <br>活动批次：{{ $order->tuan->start_time->toDateString() }} - {{ $order->tuan->end_time->toDateString() }}
        </li>
        @foreach($order->baomings as $baoming)
            <li>
                <h6>报名人{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</h6>
                <div class="row">
                    <div class="col-4">姓名：{{ $baoming->name }}</div>
                    <div class="col-4">证件类型：{{ $baoming->typeText() }}</div>
                    <div class="col-4 text-truncate">证件号：{{ $baoming->cardID }}</div>
                    <div class="col-4">联系电话：{{ $baoming->mobile }}</div>
                    <div class="col-4">紧急联系人：{{ $baoming->nameJ }}</div>
                    <div class="col-4  text-truncate">紧急电话：{{ $baoming->mobileJ }}</div>
                </div>
            </li>
        @endforeach
        <li>备注：{{ $order->remarks }}</li>
        <li>
            总人数：{{ count($order->baomings) }}人
            <br>总金额：<span class="text-danger">¥{{ $order->tuan->price * count($order->baomings) }}元</span>
            <br>订单状态：{{ $order->statusText() }}
            @if($order->status === 'wait')
                <a href="{{ route('order.qrcode', $order) }}" target="_blank" class="text-warning text-white">去支付</a>
            @endif
        </li>
    </ul>
@endsection