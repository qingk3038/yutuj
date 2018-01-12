@extends('layouts.m')

@section('title', '我的订单')

@section('header')
    @include('m.header', ['title' => '我的订单'])
@endsection

@section('content')
    <div class="pt-5">
        <ul class="nav-justified nav nav-two bg-light text-nowrap">
            <li class="nav-item">
                <a class="nav-link {{ Request::has('status') || Request::has('tno') ? '' : 'active' }}" href="{{ route('home.order') }}">全部</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::get('status') === 'wait' ? 'active' : '' }}" href="{{ route('home.order', ['status' => 'wait']) }}">待支付</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::get('tno') ? 'active' : '' }}" href="{{ route('home.order', ['tno' => 1]) }}">待出行</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::get('status') === 'cancel' ? 'active' : '' }}" href="{{ route('home.order', ['status' => 'cancel']) }}">取消/退款</a>
            </li>
        </ul>
    </div>

    <table class="table small">
        @forelse($orders as $order)
            <tr>
                <td width="60">
                    <a href="#"><img src="{{ imageCut(80, 50, $order->tuan->activity->thumb) }}" alt="{{ $order->tuan->activity->title }}" width="82" height="51"></a>
                </td>
                <td class="text-secondary px-0">
                    <a href="{{ route('home.order.show', $order) }}" class="d-block mb-1 text-dark">{{ str_limit($order->tuan->activity->title, 50) }}</a>
                    订单号：{{ $order->out_trade_no }} <br>
                    数量：{{ $order->baomings_count }} &nbsp; 总价：￥{{ $order->baomings_count * $order->tuan->price }} <br>
                    {{ $order->tuan->start_time->toDateString() }}
                </td>
                <td class="text-center text-secondary text-nowrap">
                    <p class="text-danger mb-1">{{ $order->statusText() }}</p>
                    @if($order->status === 'wait')
                        <a href="{{ route('order.qrcode', $order) }}" target="_blank" class="btn btn-sm btn-outline-warning">去支付</a>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center p-5">
                    <img src="{{ asset('m/img/empty_order.png') }}" alt="empty_travel" width="140" height="90"> <br>
                    <span class="text-secondary">没有此类型的订单</span>
                </td>
            </tr>
        @endforelse
    </table>

    @if($orders->hasMorePages())
        <hr>
        <nav class="d-flex justify-content-center">
            {{ $orders->links('vendor.pagination.m') }}
        </nav>
    @endif
@endsection

@section('footer', false)
