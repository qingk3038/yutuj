@extends('layouts.app')

@section('title', '视频中心')

@section('content')
    <div class="container">
        <img class="img-fluid" src="{{ asset('img/banner_video.jpg') }}" alt="banner_video">
    </div>

    <div class="container">
        <div class="py-4"><a href="{{ url('/') }}">首页</a> &gt; <span class="text-warning">旅拍直播</span></div>
    </div>

    <div class="container" id="film">
        <div class="bg-white p-3 list-video">
            <div class="title-video">
                <span class="lead text-warning mr-5">旅行短拍</span>
                <span>
                   <a href="{{ route('video.list') }}" @empty(Request::input('film.pid')) class="active" @endempty>全部</a>
                    @foreach($provinces_films as $province)
                        <a href="{{ route('video.list', ['film[pid]' => $province]) }}" @if(Request::input('film.pid') == $province->id) class="active" @endif>{{ $province->name }}</a>
                    @endforeach
                </span>
            </div>
            <hr class="my-2">
            <p class="title-video-subtitle">
                <a href="{{ route('video.list', array_merge(Request::only('film.pid'), ['film[field]' => 'click'])) }}" @if(Request::input('film.field', 'click') === 'click') class="active" @endif>最热点击</a>
                <a href="{{ route('video.list', array_merge(Request::only('film.pid'), ['film[field]' => 'updated_at'])) }}" @if(Request::input('film.field') === 'updated_at') class="active" @endif>最近更新</a>
                <a href="{{ route('video.list', array_merge(Request::only('film.pid'), ['film[field]' => 'created_at'])) }}" @if(Request::input('film.field') === 'created_at') class="active" @endif>最新上传</a>
            </p>
            <div class="row" style="margin: 0 -5px;">
                @foreach($films as $film)
                    <a class="col-4 box" href="{{ route('video.show', $film) }}" title="{{ $film->title }}" target="_blank">
                        <p class="position-relative">
                            <img class="img-fluid" src="{{ imageCut(380, 214, $film->thumb) }}" alt="{{ $film->title }}" width="380" height="214">
                            <i class="fa fa-2x fa-play-circle-o position-absolute"></i>
                        </p>
                        <h5>{{ $film->province->name }} · {{ str_limit($film->title, 26) }}</h5>
                        <p class="small text-truncate pl-3">{{ str_limit($film->description) }}</p>
                    </a>
                @endforeach
            </div>
            <nav class="d-flex justify-content-end pt-4">
                {{ $films->links() }}
            </nav>
        </div>
    </div>
    <div class="container" id="live">
        <div class="bg-white p-3 list-video mt-5">
            <div class="title-video">
                <span class="lead text-warning mr-5">大咖直播</span>
                <span>
                   <a href="{{ route('video.list') }}" @empty(Request::input('live.pid')) class="active" @endempty>全部</a>
                    @foreach($provinces_lives as $province)
                        <a href="{{ route('video.list', ['live[pid]' => $province]) }}" @if(Request::input('live.pid') == $province->id) class="active" @endif>{{ $province->name }}</a>
                    @endforeach
                </span>
            </div>
            <hr class="my-2">
            <p class="title-video-subtitle">
                <a href="{{ route('video.list', array_merge(Request::only('live.pid'), ['live[field]' => 'click'])) }}" @if(Request::input('live.field', 'click') === 'click') class="active" @endif>最热点击</a>
                <a href="{{ route('video.list', array_merge(Request::only('live.pid'), ['live[field]' => 'updated_at'])) }}" @if(Request::input('live.field') === 'updated_at') class="active" @endif>最近更新</a>
                <a href="{{ route('video.list', array_merge(Request::only('live.pid'), ['live[field]' => 'created_at'])) }}" @if(Request::input('live.field') === 'created_at') class="active" @endif>最新上传</a>
            </p>
            <div class="row" style="margin: 0 -5px;">
                @foreach($lives as $life)
                    <a class="col-4 box" href="{{ route('video.show', $life) }}" title="{{ $life->title }}" target="_blank">
                        <p class="position-relative">
                            <img class="img-fluid" src="{{ imageCut(380, 214, $life->thumb) }}" alt="{{ $life->title }}" width="380" height="214">
                            <i class="fa fa-2x fa-play-circle-o position-absolute"></i>
                        </p>
                        <h5>{{ $life->province->name }} · {{ str_limit($life->title, 26) }}</h5>
                        <p class="small text-truncate pl-3">{{ str_limit($life->description) }}</p>
                    </a>
                @endforeach
            </div>
            <nav class="d-flex justify-content-end pt-4">
                {{ $lives->links() }}
            </nav>
        </div>
    </div>
@endsection

@push('script')
    <script>
        (function ($) {
            // 异步加载
            $('#film').on('click', '.title-video a, .title-video-subtitle > a, ul.pagination a', function (event) {
                event.preventDefault()
                let url = $(this).attr('href') + ' #film > div'
                $('#film').load(url)
            })

            $('#live').on('click', '.title-video a, .title-video-subtitle > a, ul.pagination a', function (event) {
                event.preventDefault()
                let url = $(this).attr('href') + ' #live > div'
                $('#live').load(url)
            })
        })(jQuery);
    </script>
@endpush