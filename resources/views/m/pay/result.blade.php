@extends('layouts.m')

@section('title', '报名流程-第3步：订单结果')

@section('header')
    <header class="position-sticky text-warning container-fluid">
        <div class="row">
            <span class="col-3" onclick="history.back();"><i class="fas fa-lg fa-angle-left"></i></span>
            <span class="col text-center">{{ $order->statusText() }}</span>
            <a class="col-3 text-right" href="{{ route('home') }}"><img class="rounded-circle" src="{{ auth()->user()->avatar }}" alt="avatar" width="22" height="22"></a>
        </div>
    </header>
@endsection

@section('content')
    <div class="py-4 bg-light text-center">
        <img src="{{ asset('m/img/step_3.png') }}" alt="step_3" width="285" height="64">
    </div>

    <div class="p-4 bg-light mt-3 small">
        @if($order->status === 'success')
            <h5 class="text-success">
                <i class="far fa-smile fa-fw fa-2x align-middle"></i>
                支付成功，祝您愉快出行！
            </h5>
        @else
            <h5 class="text-danger">
                <i class="far fa-frown fa-fw fa-2x align-middle"></i>
                支付失败！
            </h5>
        @endif

        <dl class="row">
            <dt class="col-3 offset-2">支付金额</dt>
            <dd class="col-7 text-danger">yen{{ number_format($order->total_fee / 100, 2) }}</dd>

            <dt class="col-3 offset-2">订单号</dt>
            <dd class="col-7">{{ $order->out_trade_no  }}</dd>

            <dt class="col-3 offset-2">产品名称</dt>
            <dd class="col-7">{{ $order->tuan->activity->title }}</dd>
        </dl>
        <p class="text-center"><a href="{{ route('activity.show', $order->tuan->activity)  }}" class="btn btn-sm btn-outline-secondary px-4">返回活动</a></p>
        <p class="text-center"><a href="{{ route('home.order')  }}" class="text-warning"><i class="fa fa-fw fa-angle-double-right"></i>点击进入"我的订单"</a></p>
    </div>

    @if(count($activities))
        <div class="p-3 top-border">
            <div class="p-2">
                <h6 class="text-warning left-border-orange">您可能喜欢的线路</h6>
            </div>
            <div class="row px-2">
                @foreach($activities as $activity)
                    <a href="{{ route('activity.show', $activity) }}" class="col-6 px-2 text-dark">
                        <img class="d-block mb-1 w-100" src="{{ imageCut(182, 90, $activity->thumb) }}" alt="{{ $activity->title }}">
                        <p class="small">{{ str_limit($activity->title, 50) }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    @endif
@endsection

@section('footer', false)