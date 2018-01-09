@extends('layouts.m')

@section('title', '我的消息')

@section('header')
    <header class="position-absolute bg-white">
        <div class="text-warning d-flex justify-content-between">
            <span onclick="history.back();"><i class="fas fa-lg fa-angle-left"></i></span>
            <span>消息</span>
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
@endsection

@section('content')
    <!--
空消息
<div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="text-center">
        <img src="../img/empty_order.png" alt="empty_travel" width="140" height="90">
        <p class="d-block text-secondary">目前没有新消息!</p>
    </div>
</div>-->

    <div class="container-fluid mt-5 py-3 small">
        <div class="pl-5 position-relative">
            <img class="position-absolute" src="http://yutuj.com/img/icon_master.png" alt="" style="left: 0; top: 0;">
            <h6 class="text-justify">管理员给我发来了群发消息：</h6>
            <p>
                7.24避暑旅行季，省钱出去浪！7.24-28连嗨
                五天！<a href="#" class="text-warning">事不宜迟，立即进场>></a>
            </p>
            <p>
                <img src="holder.js/100px180" alt="">
            </p>
            <div class="d-flex justify-content-between text-secondary">
                <span>2小时前</span>
                <span>删除</span>
            </div>
        </div>
        <hr>
        <div class="pl-5 position-relative">
            <img class="position-absolute" src="http://yutuj.com/img/icon_message.png" alt="" style="left: 0; top: 0;">
            <i class=" unread"></i>
            <h6 class="text-justify">系统通知：</h6>
            <p>
                亲爱的土豆豆：<br>
                你的游记《上海迪士尼一日游》已经成功发表，可以招呼亲朋好友们一起来欣赏你的大作啦~ <br>
                <a href="#" class="text-warning">点击查看游记>></a>
            </p>
            <div class="d-flex justify-content-between text-secondary">
                <span>2小时前</span>
                <span>删除</span>
            </div>
        </div>
        <hr>
    </div>
@endsection