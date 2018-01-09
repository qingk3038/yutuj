@extends('layouts.m')

@section('title', '我的订单')

@section('header')
    <header class="position-absolute bg-white">
        <div class="text-warning d-flex justify-content-between">
            <span onclick="history.back();"><i class="fas fa-lg fa-angle-left"></i></span>
            <span>订单详情</span>
            <div>
                <a href="{{ route('home') }}">
                    <img class="rounded-circle" src="{{ auth()->user()->avatar }}" alt="avatar" width="22" height="22">
                </a>
                <a href="#menu" class="text-warning" data-toggle="collapse">
                    <i class="fa fa-fw fa-align-justify"></i>
                </a>
            </div>
        </div>
    </header>
    @include('m.header')
@endsection

@section('content')
    <div class="container-fluid mt-5 py-3">
        <h6 class="left-border-orange">成都4天3晚跟团游行蜜月之旅</h6>
        <small>订单编号：2598487</small>
    </div>
    <div class="container-fluid top-border p-3 small">
        产品类型：跟团游 <br>
        游玩天数：4天 <br>
        发团日期：2017-11-12 <br>
        出发地点：成都 <br>
        活动批次：2017-11-12 - 2017-11-16
    </div>
    <div class="container-fluid top-border p-3 small">
        <h6>报名人01</h6>
        姓名：张三 <br>
        证件类型：身份证 <br>
        证件号：999999999999999999 <br>
        联系电话：13684445999 <br>
        紧急联系人：李四 <br>
        急联系人电话：1555555555523
        <hr>

        <h6>报名人02</h6>
        姓名：张三 <br>
        证件类型：身份证 <br>
        证件号：999999999999999999 <br>
        联系电话：13684445999 <br>
        紧急联系人：李四 <br>
        急联系人电话：1555555555523
        <hr>

        <h6>报名人03</h6>
        姓名：张三 <br>
        证件类型：身份证 <br>
        证件号：999999999999999999 <br>
        联系电话：13684445999 <br>
        紧急联系人：李四 <br>
        急联系人电话：1555555555523
    </div>
    <div class="container-fluid top-border p-3 small">
        总人数：3人 <br>
        总金额：<span class="text-danger">¥2360元</span> <br>
        订单状态：未支付 <a href="#" class="text-warning">去支付</a>
    </div>
@endsection

@section('footer', false)
