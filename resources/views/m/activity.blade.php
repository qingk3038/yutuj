@extends('layouts.m')

@section('title', $activity->title)

@section('header')
    <header class="position-absolute text-white container-fluid">
        <div class="row">
            <span class="col-3" onclick="history.back();"><i class="fas fa-lg fa-angle-left"></i></span>
            <span class="col text-center">产品详情</span>
            <span class="col-3 text-right">
                @auth
                    <a href="{{ route('home') }}"><img class="rounded-circle" src="{{ auth()->user()->avatar }}" alt="avatar" width="22" height="22"></a>
                @else
                    <a href="{{ route('login') }}"> <i class="fa fa-fw fa-user"></i></a>
                @endauth
            </span>
        </div>
    </header>
@endsection

@section('content')
    <div id="photos" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            @foreach($activity->photos as $photo)
                <li data-target="#photos" data-slide-to="{{ $loop->index }}" @if($loop->first) class="active" @endif></li>
            @endforeach
        </ol>
        <div class="carousel-inner">
            @foreach($activity->photos as $photo)
                <div class="carousel-item @if($loop->first) active @endif">
                    <img class="d-block w-100" src="{{ imageCut(414, 220, $photo) }}" alt="展示图 {{ $loop->iteration }}">
                </div>
            @endforeach
        </div>
    </div>

    <div class="p-4">
        <h6 class="text-truncate left-border-orange">{{ $activity->title }}</h6>
        <div class="mb-1">
            @php
                $tag_btns = ['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark'];
            @endphp
            @foreach($activity->tags as $tag)
                <span class="badge badge-{{ $tag_btns[mt_rand(0, 7)] }}">{{ $tag->text }}</span>
            @endforeach
            <span class="text-warning ml-2">
                <i class="fa fa-fw fa-map-marker-alt"></i>
                <small>{{ $activity->country->name }}</small>
                <small>{{ $activity->province->name }}</small>
                <small>{{ $activity->city->name ?? '' }}</small>
                <small>{{ $activity->district->name ?? '' }}</small>
            </span>
        </div>
        <div class="mb-1 d-flex justify-content-between">
            <span>产品编号：{{ $activity->number }}</span>
            <small class="text-danger">¥<span class="lead font-weight-bold">{{ $activity->price }}</span> 起</small>
        </div>
        <hr style="margin: 1rem -1.5rem;">
        <div class="font-weight-light">
            产品类型：{{ $activity->types->pluck('text')->implode('、') }} <br>
            游玩天数：{{ $activity->trips->count() }}天 <br>
            发团日期：每月多团 <br>
            出发地点：{{ $activity->cfd }} <br>
            付款方式：支付宝、微信
        </div>
    </div>

    <a href="javascript:void(0);" class="small py-2 text-truncate text-center d-block text-dark" style="border-top: 5px solid #dddddd; border-bottom: 5px solid #dddddd; text-decoration: none" data-toggle="collapse" data-target="#tuans">
        选择批次：
        <div class="d-inline-block" id="show-tuan">加载中…</div>
    </a>

    <div class="collapse fixed-top bg-white h-100" id="tuans">
        <header class="text-warning">
            <a class="float-left px-2 text-warning" href="javascript:void(0);" data-toggle="collapse" data-target="#tuans"><i class="fas fa-lg fa-angle-left"></i></a>
            <div class="text-center">选择批次</div>
        </header>
        <ul class="list-group small" id="tuan-list">
            @foreach($activity->tuans as $tuan)
                <li class="list-group-item d-flex justify-content-between border-right-0 border-left-0 rounded-0 @unless($tuan->available()) disabled @endunless" data-action="{{ route('pay.order.create', $tuan) }}">
                    <span>{{ $tuan->start_time->toDateString() }} - {{ $tuan->end_time->toDateString() }}</span>
                    <span>已报名{{ $tuan->start_num + $tuan->usersOkCount() }}人</span>
                    <span class="text-danger">{{ $tuan->price }}元/人</span>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="p-4">
        <h6 class="left-border-orange">行程特色</h6>
        <p class="text-justify small">{!! nl2br($activity->ts) !!}</p>

        <div class="row px-2">
            @foreach($activity->tps as $tp)
                <div class="col-4 px-2">
                    <img class="img-fluid" src="{{ imageCut(220, 160, $tp) }}" alt="特色{{ $loop->iteration }}">
                </div>
            @endforeach
        </div>
    </div>

    <div class="top-border p-4">
        <h6 class="text-truncate left-border-orange mb-3">行程安排</h6>
        @foreach($activity->trips as $trip)
            <div class="small xcap">
                <i class="far fa-circle text-warning position-absolute"></i>
                <h6 class="text-truncate"><span class="text-warning">第{{ numberToChinese($loop->iteration) }}天</span> {{ $trip->title }}</h6>
                <div class="mb-1 text-justify clearfix">
                    <span class="float-left">
                        <i class="fa fa-fw text-warning fa-flag"></i> 行程：
                    </span>
                    {!! nl2br($trip->body) !!}
                </div>
                <p class="mb-1"><i class="fa fa-fw text-warning fa-hospital"></i> 住宿：{{ $trip->zhusu }} </p>
                <p class="d-flex">
                    <span class="align-self-start">
                        <i class="fa fa-fw text-warning fa-utensils"></i> 餐饮：
                    </span>
                    <span>
                        早餐：{{ $trip->zaocan }} <br>
                        午餐：{{ $trip->wucan }} <br>
                        晚餐：{{ $trip->wancan }}
                    </span>
                </p>
                @if(is_array($trip->pictures))
                    @foreach($trip->pictures as $picture)
                        <img class="img-fluid w-100 @if($loop->remaining) mb-2 @endif" src="{{ imageCut(350, 150, $picture) }}" alt="行程安排{{ $loop->iteration }}">
                    @endforeach
                @endif
            </div>
        @endforeach
    </div>

    <div class="top-border p-4 small">
        <h6 class="text-truncate left-border-orange mb-3">费用说明</h6>
        <p>
            费用包含 <br>
            {!! nl2br($activity->baohan) !!}
        </p>
        费用不含 <br>
        {!! nl2br($activity->buhan) !!}
    </div>

    <div class="top-border p-4 small">
        <h6 class="text-truncate left-border-orange mb-3">注意事项</h6>
        {!! nl2br($activity->zhuyi) !!}
    </div>

    <div class="top-border p-4 small mb-5">
        <h6 class="text-truncate left-border-orange mb-3">签约条款</h6>
        {!! nl2br($activity->qianyue) !!}
    </div>
@endsection

@section('footer')
    <footer class="fixed-bottom activity-bottom">
        <div class="text-center d-flex justify-content-between align-items-stretch small">
            <a href="#" class="swt w-25 pt-2">
                <i class="fa fa-lg fa-comment-alt"></i>
                <br>在线咨询
            </a>
            <a href="tel:{{ config('tel_400') }}" class="w-25 pt-2">
                <i class="fa fa-lg fa-phone fa-rotate-90"></i>
                <br>电话咨询
            </a>
            <span class="w-50">
                <button class="btn btn-block btn-warning rounded-0 h-100 toBaoming">下一步</button>
            </span>
        </div>
    </footer>

    <aside class="return-top" style="bottom: 60px;">
        <i class="fa fa-2x fa-arrow-alt-circle-up"></i>
    </aside>
@endsection

@push('script')
    <script>
        $('#tuan-list > li').click(function () {
            if ($(this).hasClass('disabled')) {
                return
            }
            $(this).addClass('active').siblings().removeClass('active')
            $('#show-tuan').html($(this).html())
            $('#tuans').collapse('hide')
        })

        // 选择第一个团
        initFirstTuan()

        function initFirstTuan() {
            let li = $('#tuan-list > li:not(.disabled)').first()
            if (li.length) {
                li.addClass('active')
                $('#show-tuan').html(li.html())
            } else {
                $('.toBaoming').addClass('disabled')
                $('#show-tuan').html('当前活动不可报名。')
            }
        }

        $('.toBaoming').click(function () {
            if ($(this).hasClass('disabled')) {
                return
            }
            let li = $('#tuan-list > li.active').first()
            location.href = li.data('action')
        })
    </script>
@endpush