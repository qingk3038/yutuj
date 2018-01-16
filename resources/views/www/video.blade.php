@extends('layouts.app')

@section('title', $video->title .'_视频详情')

@section('content')
    <div class="container">
        <div class="py-4"><a href="{{ url('/') }}">首页</a> &gt; <a href="{{ route('www.video.list') }}">视频</a> &gt; <span class="text-warning">视频详情</span></div>
    </div>

    <div class="container mb-4">
        <div class="bg-white p-4">
            <h4>{{ $video->title }}</h4>
            <div class="text-muted pt-2">
                <span>发布时间：{{ $video->created_at }}</span>
                <span class="mx-3">浏览量：{{ $video->click }}</span>
                <span>上传：{{ $video->admin->name }}</span>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-8">
                <div class="bg-white p-4 mb-4">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="{{ $video->url }}" allowfullscreen></iframe>
                    </div>
                </div>
                <div class="bg-white p-4">
                    <h5>内容简介</h5>
                    {!! nl2br($video->description) !!}
                </div>
            </div>
            <div class="col-4 pl-0">
                <div class="bg-white mb-4 p-3">
                    <div class="text-warning">推荐视频</div>
                    <hr>
                    @foreach($videos as $video)
                        <a href="{{ route('www.video.show', $video) }}" title="{{ $video->title }}" target="_blank">
                            <img src="{{ imageCut(363, 200, $video->thumb) }}" alt="{{ $video->title }}" class="img-fluid">
                        </a>
                        <p class="px-4 py-2">{{ str_limit($video->description, 70) }}</p>
                    @endforeach
                    <a class="row text-right" href="{{ route('www.video.list', ["{$video->type}[pid]" => $video->province_id]) }}" target="_blank">
                        <span class="col-10 font-weight-light">有<strong style="font-size: 26px;">{{ $videos_count }}</strong>条相关视频</span>
                        <span class="col-2"><i class="fa fa-angle-right text-warning"></i></span>
                    </a>
                </div>
                <div class="bg-white p-3">
                    <div class="text-warning">推荐活动</div>
                    <hr>
                    @foreach($activities as $activity)
                        <a href="{{ route('web.activity.show', $activity) }}" title="{{ $activity->title }}" target="_blank">
                            <img src="{{ imageCut(363, 200, $activity->thumb) }}" alt="{{ $activity->title }}" class="img-fluid">
                        </a>
                        <p class="px-4 py-2">
                            <span class="float-right text-warning"><strong style="font-size: 26px;">{{ $activity->price }}</strong>元起</span>
                            {{ str_limit($activity->description, 70) }}
                        </p>
                    @endforeach

                    <a class="row text-right" href="{{ route('web.activity.list', ['pid' => $video->province_id]) }}" target="_blank">
                        <span class="col-10 font-weight-light">有<strong style="font-size: 26px;">{{ $activities_count }}</strong>条相关活动</span>
                        <span class="col-2"><i class="fa fa-angle-right text-warning"></i></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection