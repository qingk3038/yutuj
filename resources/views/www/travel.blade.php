@extends('layouts.app')

@section('title', $travel->title)

@section('content')
    <div class="bg-home text-hide" style="background-image: url({{ imageCut(1920, 500, $travel->user->bg_home) }});">封面</div>
    <div class="bg-white p-2" style="border-bottom: 2px solid #E5E5E5;">
        <div class="container text-muted">
            <a href="{{ route('user.travel', $travel->user) }}">
                <img class="rounded-circle align-bottom" src="{{ $travel->user->avatar }}" alt="头像" width="120" height="120" style="margin-top: -80px;">
            </a>
            <a href="{{ route('user.travel', $travel->user) }}" class="pr-2 text-warning">
                <i class="fa fa-fw fa-lg text-warning {{ $travel->user->sex === 'F' ? ' fa-mercury' : 'fa-venus' }}"></i>
                {{ $travel->user->name ?? $travel->user->getHideMobile() }}
            </a>
            @if($travel->province)
                <span class="pr-2"><i class="fa fa-fw fa-map-marker"></i>{{ $travel->province }} {{ $travel->city }}</span>
            @endif
            <span class="pr-2"><i class="fa fa-fw fa-eye"></i>{{ $travel->click }}</span>
            <span class="pr-2"><i class="fa fa-fw fa-clock-o"></i>{{ $travel->created_at->toDateString() }}</span>
        </div>
    </div>

    <div class="container my-4">
        <div class="bg-white p-4">
            <h4>{{ $travel->title }}</h4>
            <div class="text-muted pt-2">
                <span>发布时间：{{ $travel->created_at }}</span>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-8">
                <div class="bg-white p-4 h-100 div-body">{!! $travel->body !!}</div>
            </div>
            <div class="col-4 pl-0">
                @include('www.right')
            </div>
        </div>
    </div>
@endsection