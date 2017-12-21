@extends('layouts.app')

@section('title', '视频中心')

@section('content')
    <div class="container">
        <img class="img-fluid" src="{{ asset('img/banner_video.jpg') }}" alt="banner_video">
    </div>

    <div class="container">
        <div class="py-4"><a href="{{ url('/') }}">首页</a> &gt; <span class="text-warning">旅拍直播</span></div>
    </div>

    <div class="container">
        <div class="bg-white p-3 list-video">
            <div class="title-video">
                <span class="lead text-warning mr-5">旅行短拍</span>
                <span>
                <a href="javascript:void(0);" class="active">全部</a>
                <a href="javascript:void(0);">四川</a>
                <a href="javascript:void(0);">西藏</a>
                <a href="javascript:void(0);">新疆</a>
                <a href="javascript:void(0);">云南</a>
                <a href="javascript:void(0);">青海</a>
                <a href="javascript:void(0);">陕甘宁</a>
                <a href="javascript:void(0);">内蒙古</a>
                <a href="javascript:void(0);">贵州</a>
                <a href="javascript:void(0);">重庆</a>
            </span>
            </div>
            <hr class="my-2">
            <p class="title-video-subtitle">
                <a href="javascript:void(0);" class="active">最热点击</a>
                <a href="javascript:void(0);">精彩推荐</a>
                <a href="javascript:void(0);">最新上传</a>
            </p>
            <div class="row" style="margin: 0 -5px;">
                @foreach($films as $film)
                    <a class="col-4 box" href="{{ route('www.video.show', $film) }}" title="{{ $film->title }}"  target="_blank">
                        <p class="position-relative">
                            <img class="img-fluid" src="{{ imageCut(380, 214, $film->thumb) }}" alt="{{ $film->title }}" width="380" height="214">
                            <i class="fa fa-2x fa-play-circle-o position-absolute"></i>
                        </p>
                        <h5>{{ $film->province->name }} · {{ str_limit($film->title, 26) }}</h5>
                        <p class="small text-truncate pl-3">{{ str_limit($film->description) }}</p>
                    </a>
                @endforeach
            </div>
            <nav class="d-flex justify-content-end pt-4 w-100">
                {{ $films->links() }}
            </nav>
        </div>
    </div>

    <div class="container mt-5">
        <div class="bg-white p-3 list-video">
            <div class="title-video">
                <span class="lead text-warning mr-5">大咖直播</span>
                <span>
                <a href="javascript:void(0);" class="active">全部</a>
                <a href="javascript:void(0);">四川</a>
                <a href="javascript:void(0);">西藏</a>
                <a href="javascript:void(0);">新疆</a>
                <a href="javascript:void(0);">云南</a>
                <a href="javascript:void(0);">青海</a>
                <a href="javascript:void(0);">陕甘宁</a>
                <a href="javascript:void(0);">内蒙古</a>
                <a href="javascript:void(0);">贵州</a>
                <a href="javascript:void(0);">重庆</a>
            </span>
            </div>
            <hr class="my-2">
            <p class="title-video-subtitle">
                <a href="javascript:void(0);" class="active">最热点击</a>
                <a href="javascript:void(0);">精彩推荐</a>
                <a href="javascript:void(0);">最新上传</a>
            </p>
            <div class="row" style="margin: 0 -5px;">
                @foreach($lives as $life)
                    <a class="col-4 box" href="{{ route('www.video.show', $life) }}" title="{{ $life->title }}" target="_blank">
                        <p class="position-relative">
                            <img class="img-fluid" src="{{ imageCut(380, 214, $life->thumb) }}" alt="{{ $life->title }}" width="380" height="214">
                            <i class="fa fa-2x fa-play-circle-o position-absolute"></i>
                        </p>
                        <h5>{{ $life->province->name }} · {{ str_limit($life->title, 26) }}</h5>
                        <p class="small text-truncate pl-3">{{ str_limit($life->description) }}</p>
                    </a>
                @endforeach
            </div>

            <nav class="d-flex justify-content-end pt-4 w-100">
                {{ $lives->links() }}
            </nav>
        </div>
    </div>
@endsection