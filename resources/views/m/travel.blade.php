@extends('layouts.m')

@section('title', $travel->title)

@section('header')
    @include('m.header', ['title' => '游记详情'])
@endsection

@section('content')
    <img class="d-block w-100" src="{{ imageCut(414, 220, $travel->user->bg_home) }}" alt="主页背景">
    <div class="bg-white p-3">
        <div class="text-muted small d-flex">
            <a href="{{ route('user.travel', $travel->user) }}" class="text-warning mr-2">
                <img class="rounded-circle align-bottom" src="{{ imageCut(60, 60, $travel->user->avatar) }}" alt="头像" style="margin-top: -80px;" height="60" width="60">
                <i class="fa fa-lg @if($travel->user->sex === 'M') fa-mars @else fa-mercury @endif"></i>
                {{ $travel->user->name ?? $travel->user->getHideMobile() }}
            </a>
            @if($travel->province)
                <span class="mr-2"><i class="fa fa-map-marker-alt"></i> {{ $travel->province }} {{ $travel->city }}</span>
            @endif
            <span class="mr-2"><i class="fa fa-eye"></i> {{ $travel->click }}</span>
            <span class="ml-auto"><i class="far fa-clock"></i> {{ $travel->created_at->toDateString() }}</span>
        </div>
    </div>

    <div class="top-border p-3">
        <h6 class="left-border-orange text-truncate mb-0">{{ $travel->title }}</h6>
    </div>

    <div class="top-border p-3 small div-body">
        {!! $travel->body !!}
    </div>
@endsection