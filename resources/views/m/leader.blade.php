@extends('layouts.m')

@section('title', '领队' . $leader->name . '的主页')

@section('header')
    <header class="position-absolute text-white container-fluid">
        <div class="row">
            <span class="col-3" onclick="history.back();"><i class="fas fa-lg fa-angle-left"></i></span>
            <span class="col text-center">领队详情</span>
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
    <div class="position-relative show-leader">
        <div class="bg-leader text-hide position-absolute" style="background-image: url({{ imageCut(414, 220, $leader->bg_home) }});"></div>
        <div class="text-center">
            <div class="avatar position-relative">
                <img class="rounded-circle" src="{{ imageCut(120, 120, $leader->avatar) }}" alt="{{ $leader->name }}" height="120" width="120">
                <span class="fa-stack position-absolute">
                    @if($leader->sex === 'F')
                        <i class="fa fa-circle fa-stack-2x text-danger"></i>
                        <i class="fa fa-venus fa-stack-1x fa-inverse"></i>
                    @else
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-mars fa-stack-1x fa-inverse"></i>
                    @endif
            </span>
            </div>
            <div class="text-white px-3 small font-weight-light">{{ $leader->brief }}</div>
        </div>
    </div>
    <div class="top-border pt-3">
        <div class="media bg-light p-3">
            <img class="mr-3" src="{{ imageCut(100, 150, $leader->avatar) }}" alt="{{ $leader->name }}" width="100" height="150">
            <div class="media-body">
                <h5 class="text-warning left-border-orange ml-0">{{ $leader->name }}</h5>
                <p class="small mb-1 text-warning text-justify">
                    <i class="fa fa-map-marker-alt"></i>
                    <span class="mr-1">{{ $leader->country->name }}</span>
                    <span class="mr-1">{{ $leader->province->name }}</span>
                    <span class="mr-1">{{ $leader->city->name ?? ''}}</span>
                    <span class="mr-1">{{ $leader->district->name ?? '' }}</span>
                </p>
                <div class="small font-weight-light">{!! nl2br($leader->description) !!}</div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <p class="text-warning text-center mt-3">关于TA</p>
        <hr>
        <p class="mb-1"><i class="fa fa-quote-left fa-lg text-secondary"></i></p>
        <div class="small font-weight-light">{!! nl2br($leader->introduction) !!}</div>
        <p class="text-right"><i class="fa fa-quote-right fa-lg text-secondary"></i></p>
    </div>

    <div class="py-3" style="border-top: 10px solid #f7f7f7; border-bottom: 10px solid #f7f7f7;">
        <div class="roll-x">
            <div class="d-flex flex-nowrap">
                @foreach($leader->photos as $photo)
                    <img class="m-1" src="{{ imageCut(165, 140, $photo) }}" alt="展示图{{ $loop->iteration }}">
                @endforeach
            </div>
        </div>
    </div>

    @if(count($leader->activities))
        <div class="p-3 text-warning text-center">TA领队的活动</div>
        <div class="a-list">
            @php
                $tag_btns = ['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark'];
            @endphp
            @foreach($leader->activities as $activity)
                <a href="{{ route('m.activity.show', $activity) }}" class="card rounded-0 border-0">
                    <img class="card-img-top" src="{{ imageCut(375, 150, $activity->thumb) }}" alt="{{ $activity->title }}">
                    <div class="card-body">
                        <h6 class="text-truncate">{{ $activity->province->name }} · {{ $activity->title }}</h6>
                        <p class="card-text text-truncate small">{{ $activity->description }}</p>
                    </div>
                    <small class="position-absolute text-warning">
                        ¥<span class="lead font-weight-bold">{{ $activity->price }}</span> 起
                    </small>
                    <p class="position-absolute mb-0">
                        @foreach($activity->tags as $tag)
                            <span class="badge badge-pill badge-{{ $tag_btns[mt_rand(0, 7)] }} mr-1">{{ $tag->text }}</span>
                        @endforeach
                    </p>
                </a>
            @endforeach
            <p class="text-center">
                <a href="{{ route('m.activity.list') }}" class="btn btn-sm btn-warning">更多活动</a>
            </p>
        </div>
    @endif

@endsection

@push('script')
    <link href="{{ asset('css/jquery.mCustomScrollbar.min.css') }}" rel="stylesheet">
    <script src="{{ asset('js/jquery.mCustomScrollbar.min.js') }}"></script>
    <script>
        (function ($) {
            $('.roll-x').mCustomScrollbar({
                axis: 'x',
                theme: 'rounded-dark',
                scrollbarPosition: 'outside'
            })
        })(jQuery);
    </script>
@endpush