@extends('layouts.m')

@section('title', '官方首页')

@section('header')
    <header class="position-absolute text-white d-flex justify-content-between">
        <img src="{{ asset('m/img/logo_white.png') }}" alt="logo" width="86" height="27">
        <div>
            @guest
                <a href="{{ route('login') }}">
                    <i class="fa fa-fw fa-user"></i>
                </a>
            @else
                <a href="{{ route('home') }}">
                    <img class="rounded-circle" src="{{ auth()->user()->avatar }}" alt="avatar" width="22" height="22">
                </a>
            @endguest
            <a href="#menu" data-toggle="collapse" class="align-middle">
                <i class="fa fa-fw fa-align-justify"></i>
            </a>
        </div>
    </header>
    <nav class="collapse font-weight-light position-absolute" id="menu">
        <a href="{{ url('/') }}">首页</a>
        <a href="{{ route('m.activity.list', ['nid' => 2]) }}">纵横西部</a>
        <a href="{{ route('m.activity.list', ['nid' => 3]) }}">微上西部</a>
        <a href="{{ route('m.activity.list', ['nid' => 4]) }}">超级周末</a>
        <a href="{{ route('m.activity.list', ['nid' => 5]) }}">最6旅行</a>
        <a href="{{ url('customized') }}">定制游</a>
        <a href="{{ route('m.activity.list') }}">活动</a>
        <a href="{{ route('m.raider.list') }}">攻略</a>
        <a href="{{ route('m.travel.list') }}">游记</a>
        <a href="{{ route('m.leader.list') }}">大咖领路</a>
        <a href="{{ route('m.video.list') }}">旅拍直播</a>
        <a href="{{ route('m.article.show', 1) }}">关于我们</a>
    </nav>
@endsection

@section('content')
    @include('m.provinces')

    <section class="position-absolute text-center font-weight-light text-truncate small" id="index-nav">
        <a href="{{ route('m.activity.list', ['nid' => 2]) }}"><img src="{{ asset('m/img/nav_1.png') }}" alt="纵横西部"> 纵横西部</a>
        <a href="{{ route('m.activity.list', ['nid' => 3]) }}"><img src="{{ asset('m/img/nav_2.png') }}" alt="微上西部"> 微上西部</a>
        <a href="{{ route('m.activity.list', ['nid' => 4]) }}"><img src="{{ asset('m/img/nav_3.png') }}" alt="超级周末"> 超级周末</a>
        <a href="{{ route('m.activity.list', ['nid' => 5]) }}"><img src="{{ asset('m/img/nav_4.png') }}" alt="最6旅行"> 最6旅行</a>
        <a href="{{ url('customized') }}"><img src="{{ asset('m/img/nav_5.png') }}" alt="定制旅行"> 定制旅行</a>
    </section>


    <div id="banner" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators" style="bottom: 35%;">
            <li data-target="#banner" data-slide-to="0" class="active"></li>
            <li data-target="#banner" data-slide-to="1"></li>
            <li data-target="#banner" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" style="bottom: 40%;">
            <div class="carousel-item active">
                <img class="d-block w-100" src="{{ asset('m/img/banner_1.jpg') }}" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="{{ asset('m/img/banner_1.jpg') }}" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="{{ asset('m/img/banner_1.jpg') }}" alt="Third slide">
            </div>
        </div>
    </div>

    <div class="top-border">
        <div class="clearfix text-warning p-3">
            <i class="fab fa-fw fa-2x fa-hotjar float-left my-2 mr-2"></i>
            <div>
                <h5 class="mb-0">热门线路</h5>
                <small class="text-muted">当季最热目的地</small>
            </div>
        </div>
        <div id="line" class="carousel slide slide-two" data-ride="carousel">
            <div class="carousel-inner">
                @foreach($hots as $activity)
                    <div class="carousel-item @if($loop->first) active @endif">
                        <img class="d-block w-100" src="{{ imageCut(414, 200, $activity->thumb) }}" alt="{{ $activity->short }}" width="414" height="200">
                        <div class="carousel-caption">
                            <h5>{{ str_limit($activity->short, 20) }}</h5>
                            <small class="pl-3">{{ str_limit($activity->title, 36)}}</small>
                        </div>
                        <div class="position-absolute btn-see">
                            <small class="text-white d-block">¥<strong class="lead">{{ $activity->price }}</strong>起</small>
                            <a href="{{ route('m.activity.show', $activity) }}" class="btn btn-sm btn-block btn-outline-light">去看看</a>
                        </div>
                    </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#line" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#line" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>


    <div class="top-border">
        <div class="clearfix text-warning p-3">
            <i class="fas fa-fw fa-2x fa-camera-retro float-left my-2 mr-2"></i>
            <div>
                <h5 class="mb-0">精彩专区</h5>
                <small class="text-muted">更多，更好，更精彩</small>
            </div>
        </div>

        <ul class="justify-content-center nav nav-two mb-3">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#wan">别样玩法</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#leader">大咖领路</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#hotel">旅居当地</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="wan">
                <div id="wans" class="carousel slide slide-two" data-ride="carousel">
                    <div class="carousel-inner">
                        @foreach($wans as $wan)
                            <div class="carousel-item @if($loop->first) active @endif">
                                <img class="d-block w-100" src="{{ imageCut(414, 200, $wan->thumb) }}" alt="{{ $wan->short }}" width="414" height="200">
                                <div class="carousel-caption text-truncate">
                                    <h5 class="w-75">{{ $wan->short }}</h5>
                                    <small class="pl-3 w-75 d-block">{{ $wan->title }}</small>
                                </div>
                                <div class="position-absolute btn-see">
                                    <a href="{{ route('m.raider.show', $wan) }}" class="btn btn-sm btn-block btn-outline-light">去看看</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#wans" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#wans" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="tab-pane fade" id="leader">
                <div id="leaders" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        @foreach($leaders as $leader)
                            <div class="carousel-item @if($loop->first) active @endif">
                                <dl class="row p-2">
                                    <dt class="col-5 text-center">
                                        <a href="{{ route('m.leader.show', $leader) }}">
                                            <img class="rounded-circle img-fluid" src="{{ imageCut(140, 140, $leader->avatar) }}" alt="{{ $leader->name }}" width="140" height="140">
                                        </a>
                                    </dt>
                                    <dd class="col-7 text-justify">
                                        <h5 class="text-warning pl-2" style="border-left: 2px solid #FF9900; margin-left: -0.7rem;">领队 · {{ $leader->name }}</h5>
                                        <small class="text-secondary">{{ str_limit($leader->brief) }}</small>
                                    </dd>
                                </dl>
                            </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#leaders" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#leaders" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="tab-pane fade" id="hotel">
                <div id="hotels" class="carousel slide slide-two" data-ride="carousel">
                    <div class="carousel-inner">
                        @foreach($hospitals as $hospital)
                            <div class="carousel-item @if($loop->first) active @endif">
                                <img class="d-block w-100" src="{{ imageCut(414, 200, $hospital->thumb) }}" alt="{{ $hospital->short }}" width="414" height="200">
                                <div class="carousel-caption text-truncate">
                                    <h5 class="w-75">{{ $hospital->short }}</h5>
                                    <small class="pl-3 w-75 d-block">{{ $hospital->title }}</small>
                                </div>
                                <div class="position-absolute btn-see">
                                    <a href="{{ route('m.raider.show', $hospital) }}" class="btn btn-sm btn-block btn-outline-light">去看看</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#hotels" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#hotels" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="clearfix my-2 jc-zq">
            <a href="{{ route('m.raider.list') }}" class="w-50 float-left pr-1 position-relative text-white">
                <img src="{{ asset('m/img/raider.png') }}" alt="raider" class="img-fluid">
                <div class="position-absolute">
                    <p class="mb-1"><i class="far fa-lg fa-compass"></i></p>
                    <h6 class="mb-0">旅游攻略</h6>
                    <small>美食 · 景点 · 线路 · 酒店</small>
                </div>
            </a>
            <a href="{{ route('m.travel.list') }}" class="w-50 float-right pl-1 position-relative text-white">
                <img src="{{ asset('m/img/travel.png') }}" alt="travel" class="img-fluid">
                <div class="position-absolute">
                    <p class="mb-1"><i class="fa fa-lg fa-book"></i></p>
                    <h6 class="mb-0">游记</h6>
                    <small>分享真实的足迹</small>
                </div>
            </a>
        </div>
    </div>

    <div class="top-border">
        <div class="clearfix text-warning p-3">
            <i class="far fa-fw fa-2x fa-play-circle float-left my-2 mr-2"></i>
            <div>
                <h5 class="mb-0">旅拍/直播</h5>
                <small class="text-muted">分享旅途心情，分享新的世界</small>
            </div>
        </div>

        <ul class="justify-content-center nav nav-two mb-3">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#film">旅行短拍</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#live">大咖直播</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="film">
                <div id="films" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @foreach($films as $film)
                            <li data-target="#films" data-slide-to="{{ $loop->index }}" @if($loop->first) class="active" @endif></li>
                        @endforeach
                    </ol>
                    <div class="carousel-inner">
                        @foreach($films as $film)
                            <a href="{{ route('m.video.show', $film) }}" class="carousel-item @if($loop->first) active @endif">
                                <img class="d-block w-100" src="{{ imageCut(414, 200, $film->thumb) }}" alt="{{ $film->title }}" width="414" height="200">
                                <div class="carousel-caption text-truncate">
                                    <p class="text-center"><i class="far fa-3x fa-play-circle"></i></p>
                                    {{ $film->title }}
                                </div>
                            </a>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#films" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#films" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="tab-pane fade" id="live">
                <div id="lives" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @foreach($lives as $life)
                            <li data-target="#films" data-slide-to="{{ $loop->index }}" @if($loop->first) class="active" @endif></li>
                        @endforeach
                    </ol>
                    <div class="carousel-inner">
                        @foreach($lives as $life)
                            <a href="{{ route('m.video.show', $life) }}" class="carousel-item @if($loop->first) active @endif" target="_blank">
                                <img class="d-block w-100" src="{{ imageCut(414, 200, $life->thumb) }}" alt="{{ $life->title }}" width="414" height="200">
                                <div class="carousel-caption text-truncate">
                                    <p class="text-center"><i class="far fa-3x fa-play-circle"></i></p>
                                    {{ $life->title }}
                                </div>
                            </a>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#lives" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#lives" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="top-border">
        <div class="clearfix text-warning p-3">
            <i class="fa fa-fw fa-2x fa-map-marker-alt float-left my-2 mr-2"></i>
            <div>
                <h5 class="mb-0">目的地</h5>
                <small class="text-muted">就是要和别人玩儿的不一样</small>
            </div>
        </div>

        <div class="slide-two infiniteScroll" id="loadList">
            <ul class="nav nav-justified nav-two mb-3 flex-nowrap text-nowrap">
                @foreach($navs as $nav)
                    <li class="nav-item">
                        <a class="nav-link px-1 @if(request('nid', array_first($navs)->id) == $nav->id) active @endif" href="?nid={{ $nav->id }}">{{ $nav->text }}</a>
                    </li>
                @endforeach
            </ul>
            <div class="item">
                @foreach($activities as $activity)
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="{{ imageCut(414, 200, $activity->thumb) }}" alt="{{ $activity->short }}" width="414" height="200">
                        <div class="carousel-caption">
                            <h5 class="text-truncate w-75">{{ $activity->province->name }} · {{ $activity->short }}</h5>
                            <small class="pl-3 d-block text-truncate w-75">{{ $activity->title }}</small>
                        </div>
                        <div class="position-absolute btn-see">
                            <small class="text-white d-block">¥<strong class="lead">{{ $activity->price }}</strong>起</small>
                            <a href="{{ route('activity.show', $activity) }}" class="btn btn-sm btn-block btn-outline-light">去看看</a>
                        </div>
                    </div>
                    <p class="text-right mb-0 p-2 small">
                        <a href="{{ route('m.activity.list', ['pid' => $activity->province]) }}" class="text-secondary">
                            <i class="fa fa-fw fa-angle-right"></i>更多{{ $activity->province->name }}
                        </a>
                    </p>
                @endforeach
            </div>
            <nav class="d-flex justify-content-center">
                {{ $activities->appends(Request::only('nid'))->links('vendor.pagination.m') }}
            </nav>
        </div>
        <div class="text-center text-secondary small page-load-status" style="display: none;">
            <p class="infinite-scroll-request"><i class="fas fa-sync fa-spin"></i> 更多精彩加载中...</p>
            <p class="infinite-scroll-last">已全部加载</p>
        </div>
    </div>
@endsection

@push('script')
    <script>
        // 异步加载
        $('#loadList').on('click', 'ul.nav a', function (event) {
            event.preventDefault()
            let url = $(this).attr('href') + ' #loadList'
            $('#loadList').load(url, initInfiniteScroll)
        })
    </script>
@endpush