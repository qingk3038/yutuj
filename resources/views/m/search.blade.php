@extends('layouts.m')

@section('title', sprintf('搜索"%s"的结果', request('q')))

@section('header')
    @include('m.header', ['title' => '搜索', 'theme' => 'white'])
    @include('m.provinces')
@endsection

@section('content')
    <div class="container-fluid py-4">
        <ul class="nav nav-justified nav-search text-nowrap flex-nowrap">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle @if(request('s', 'activity') === 'activity') active @endif" data-toggle="dropdown" href="#">线路活动</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item @if(!request('nid') && request('s', 'activity') === 'activity') active @endif" href="{{ route('search', ['s' => 'activity', 'q' => request('q'), 'pid' => request('pid')]) }}">全部活动</a>
                    @foreach($navs as $nav)
                        <a class="dropdown-item @if(request('nid') == $nav->id) active @endif" href="{{ route('search', ['s' => 'activity', 'q' => request('q'), 'pid' => request('pid'), 'nid' => $nav]) }}">{{ $nav->text }}</a>
                    @endforeach
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle @if(request('s') === 'raider') active @endif" data-toggle="dropdown" href="#">线路攻略</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item @if(!request('r') && request('s') === 'raider') active @endif" href="{{ route('search', ['s' => 'raider', 'q' => request('q'), 'pid' => request('pid')]) }}">全部攻略</a>
                    <a class="dropdown-item @if(request('r') === 'default') active @endif" href="{{ route('search', ['s' => 'raider', 'q' => request('q'), 'pid' => request('pid'), 'r' => 'default']) }}">玩法攻略</a>
                    <a class="dropdown-item @if(request('r') === 'line') active @endif" href="{{ route('search', ['s' => 'raider', 'q' => request('q'), 'pid' => request('pid'), 'r' => 'line']) }}">线路攻略</a>
                    <a class="dropdown-item @if(request('r') === 'food') active @endif" href="{{ route('search', ['s' => 'raider', 'q' => request('q'), 'pid' => request('pid'), 'r' => 'food']) }}">美食攻略</a>
                    <a class="dropdown-item @if(request('r') === 'scenic') active @endif" href="{{ route('search', ['s' => 'raider', 'q' => request('q'), 'pid' => request('pid'), 'r' => 'scenic']) }}">景点攻略</a>
                    <a class="dropdown-item @if(request('r') === 'hospital') active @endif" href="{{ route('search', ['s' => 'raider', 'q' => request('q'), 'pid' => request('pid'), 'r' => 'scenic']) }}">住宿攻略</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle @if(request('s') === 'video') active @endif" data-toggle="dropdown" href="#">旅途短拍</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item @if(request('v') === 'film') active @endif" href="{{ route('search', ['s' => 'video', 'q' => request('q'), 'pid' => request('pid'), 'v' => 'film']) }}">旅途短拍</a>
                    <a class="dropdown-item @if(request('v') === 'live') active @endif" href="{{ route('search', ['s' => 'video', 'q' => request('q'), 'pid' => request('pid'), 'v' => 'live']) }}">大咖直播</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(request('s') === 'travel') active @endif" href="{{ route('search', ['s' => 'travel', 'q' => request('q'), 'pid' => request('pid')]) }}">精彩游记</a>
            </li>
        </ul>
    </div>

    {{--产品--}}
    @switch(request('s', 'activity'))

        @case('activity')
        <div class="a-list infiniteScroll">
            @php
                $tag_btns = ['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark'];
            @endphp
            @foreach($activities as $activity)
                <a href="{{ route('m.activity.show', $activity) }}" class="card border-0 item">
                    <img class="card-img-top rounded-0" src="{{ imageCut(414, 150, $activity->thumb) }}" alt="{{ $activity->title }}" width="414" height="150">
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
            <nav class="d-flex justify-content-center">
                {{ $activities->appends(Request::all())->links('vendor.pagination.m') }}
            </nav>
        </div>
        @break

        @case('raider')
        <div class="a-list infiniteScroll">
            @foreach($raiders as $raider)
                <a href="{{ route('m.raider.show', $raider) }}" class="card border-0 item">
                    <img class="card-img-top rounded-0" src="{{ imageCut(414, 150, $raider->thumb) }}" alt="{{ $raider->title }}" width="414" height="150">
                    <div class="card-body">
                        <h6 class="text-truncate w-100">{{ $raider->typeText() }} · {{ $raider->title }}</h6>
                        <p class="mb-1 text-truncate small">{{ $raider->description }}</p>
                        <p class="mb-0 d-flex small text-secondary text-truncate">
                            <span class="mr-3"><i class="fa fa-map-marker-alt"></i> {{ $raider->province->name }} {{ $raider->city->name ?? '' }}</span>
                            <span class="mr-3"><i class="fa fa-eye"></i> {{ $raider->click }}</span>
                            <span class="mr-3"><i class="fa fa-thumbs-up"></i> {{ $raider->likes_count }}</span>
                            <span class="mr-3"><i class="fa fa-user"></i> {{ $raider->admin->name }}</span>
                            <span class="ml-auto"><i class="far fa-clock"></i> {{ $raider->created_at->toDateString() }}</span>
                        </p>
                    </div>
                </a>
            @endforeach
            <nav class="d-flex justify-content-center">
                {{ $raiders->appends(Request::all())->links('vendor.pagination.m') }}
            </nav>
        </div>
        @break

        @case('video')
        <div class="a-list infiniteScroll">
            @foreach($videos as $video)
                <a href="{{ route('m.video.show', $video) }}" class="card border-0 item" @if($video->type === 'live') target="_blank" @endif>
                    <img class="card-img-top rounded-0" src="{{ imageCut(414, 150, $video->thumb) }}" alt="{{ $video->title }}" width="414" height="150">
                    <div class="card-body">
                        <h6 class="text-truncate">{{ $video->province->name }} · {{ $video->title }}</h6>
                        <p class="card-text text-truncate small">{{ $video->description }}</p>
                    </div>
                    <p class="position-absolute mb-0">
                        <i class="fa fa-play-circle fa-lg"></i>
                    </p>
                </a>
            @endforeach
            <nav class="d-flex justify-content-center">
                {{ $videos->appends(Request::all())->links('vendor.pagination.m') }}
            </nav>
        </div>
        @break

        @case('travel')
        <div class="a-list infiniteScroll">
            @foreach($travels as $travel)
                <a href="{{ route('m.travel.show', $travel) }}" class="card border-0 item">
                    <img class="card-img-top rounded-0" src="{{ imageCut(414, 150, $travel->thumb)  }}" alt="{{ $travel->title }}" width="414" height="150">
                    <div class="card-body">
                        <h6 class="text-truncate">{{ $travel->title }}</h6>
                        <p class="mb-2 text-truncate small">{{ $travel->description }}</p>
                        <p class="mb-0 d-flex small text-secondary text-truncate">
                            @if($travel->province)
                                <span class="mr-2"><i class="fa fa-map-marker-alt"></i> {{ $travel->province }} {{ $travel->city }}</span>
                            @endif
                            <span class="mr-2"><i class="fa fa-eye"></i> {{ $travel->click }}</span>
                            <span class="mr-2"><i class="fa fa-thumbs-up"></i> {{ $travel->likes_count }}</span>
                            <span class="mr-2"><i class="fa fa-user"></i> {{ $travel->user->name ?? $travel->user->getHideMobile() }}</span>
                            <span class="ml-auto"><i class="far fa-clock"></i> {{ $travel->created_at->toDateString() }}</span>
                        </p>
                    </div>
                </a>
            @endforeach
            <nav class="d-flex justify-content-center">
                {{ $travels->appends(Request::all())->links('vendor.pagination.m') }}
            </nav>
        </div>
        @break

    @endswitch
    <div class="text-center text-secondary small page-load-status" style="display: none;">
        <p class="infinite-scroll-request"><i class="fas fa-sync fa-spin"></i> 更多精彩加载中...</p>
        <p class="infinite-scroll-last">已全部加载</p>
        <p class="infinite-scroll-error">已全部加载</p>
    </div>
@endsection