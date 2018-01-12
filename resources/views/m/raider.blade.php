@extends('layouts.m')

@section('title', $raider->title)

@section('header')
    <header class="position-absolute text-white container-fluid">
        <div class="row">
            <span class="col-3" onclick="history.back();"><i class="fas fa-lg fa-angle-left"></i></span>
            <span class="col text-center">攻略详情</span>
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

    @if(count($activities))
        <div class="p-3 top-border">
            <div class="p-2">
                <h6 class="text-warning left-border-orange">您可能喜欢的线路</h6>
            </div>
            <div class="row px-2">
                @foreach($activities as $activity)
                    <a href="{{ route('m.activity.show', $activity) }}" class="col-6 px-2 text-dark">
                        <img class="d-block mb-1 w-100" src="{{ imageCut(182, 90, $activity->thumb) }}" alt="{{ $activity->title }}">
                        <p class="small">{{ str_limit($activity->title, 50) }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    @endif
@endsection