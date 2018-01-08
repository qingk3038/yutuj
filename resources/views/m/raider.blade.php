@extends('layouts.m')

@section('title', $raider->title)

@section('header')
    <header class="position-absolute">
        <div class="text-white d-flex justify-content-between">
            <span onclick="history.back();"><i class="fas fa-lg fa-angle-left"></i></span>
            <span>攻略详情</span>
            <a href="auth/login.html">
                <i class="fa fa-fw fa-user"></i>
                <!--<img class="rounded-circle" src="img/avatar.png" alt="avatar" width="22" height="22">-->
            </a>
        </div>
    </header>
@endsection

@section('content')
    <img class="d-block w-100" src="{{ imageCut(414, 220, $raider->thumb) }}" alt="{{ $raider->title }}">

    <div class="p-4">
        <h6 class="left-border-orange text-truncate">{{ $raider->typeText() }} · {{ $raider->title }}</h6>
        <div class="small text-secondary text-truncate">
            <span class="mr-2"><i class="fa fa-map-marker-alt"></i> {{ $raider->province->name }}</span>
            <span class="mr-2"><i class="fa fa-eye"></i> {{ $raider->click }}</span>
            <span class="mr-2"><i class="fa fa-user"></i> {{ $raider->admin->name }}</span>
            <span class="mr-2"><i class="far fa-clock"></i> {{ $raider->created_at->toDateString() }}</span>
        </div>
    </div>

    <hr class="m-0">

    <div class="px-3 small div-body text-justify">{!! $raider->body !!}</div>

    <div class="p-3 top-border">
        <div class="p-2">
            <h6 class="text-warning left-border-orange">您可能喜欢的线路</h6>
        </div>
        <div class="row px-2">
            <a href="#" class="col-6 px-2 text-dark">
                <img class="d-block mb-1" src="holder.js/100px90" alt="Card image cap">
                <p class="small">新疆南北深度包车VIP自由行，多车型任选（暑期特惠）</p>
            </a>
            <a href="#" class="col-6 px-2 text-dark">
                <img class="d-block mb-1" src="holder.js/100px90" alt="Card image cap">
                <p class="small">新疆南北深度包车VIP自由行，多车型任选（暑期特惠）</p>
            </a>
            <a href="#" class="col-6 px-2 text-dark">
                <img class="d-block mb-1" src="holder.js/100px90" alt="Card image cap">
                <p class="small">新疆南北深度包车VIP自由行，多车型任选（暑期特惠）</p>
            </a>
            <a href="#" class="col-6 px-2 text-dark">
                <img class="d-block mb-1" src="holder.js/100px90" alt="Card image cap">
                <p class="small">新疆南北深度包车VIP自由行，多车型任选（暑期特惠）</p>
            </a>
        </div>
    </div>
@endsection