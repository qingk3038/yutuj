@extends('layouts.m')

@section('title', $video->title)

@section('header')
    @include('m.header', ['title' => '视频详情', 'theme' => 'white'])
@endsection

@section('content')
    <div class="p-3 mt-5">
        <p class="text-truncate mb-2">{{ $video->title }}</p>
        <div class="text-secondary small d-flex justify-content-between">
            <span>发布时间：{{ $video->created_at->toDateString() }}</span>
            <span>浏览量：{{ $video->click }}</span>
            <span>上传：{{ $video->admin->name }}</span>
        </div>
    </div>

    <div class="embed-responsive embed-responsive-16by9">
        <iframe class="embed-responsive-item" src="{{ $video->url }}" allowfullscreen></iframe>
    </div>

    <div class="p-3 top-border">
        <p class="mb-2">内容简介</p>
        <small> {!! nl2br($video->description) !!}</small>
    </div>

    @if(count($videos))
        <div class="text-warning p-3 top-border">更多推荐</div>
        <div class="a-list">
            @foreach($videos as $video)
                <a href="{{ route('m.video.show', $video) }}" class="card rounded-0 border-0">
                    <img class="card-img-top" src="{{ imageCut(414, 150, $video->thumb) }}" alt="{{ $video->title }}">
                    <div class="card-body">
                        <h6 class="text-truncate">{{ $video->province->name }} · {{ $video->title }}</h6>
                        <p class="card-text text-truncate small">{{ str_limit($video->description) }}</p>
                    </div>
                    <p class="position-absolute mb-0">
                        <i class="fa fa-play-circle fa-lg"></i>
                    </p>
                </a>
            @endforeach
        </div>
    @endif
@endsection