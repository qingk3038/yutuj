@extends('layouts.app')

@section('title', '领队' . $leader->name . '的主页')

@section('content')
    <div class="position-relative show-leader">
        <div class="bg-leader text-hide position-absolute" style="background-image: url({{ Storage::url($leader->bg_home) }});"></div>
        <div class="container text-center">
            <div class="avatar position-relative">
                <img class="rounded-circle" src="{{ imageCut(120, 120, $leader->avatar) }}" alt="{{ $leader->name }}" width="120" height="120">
                <span class="fa-stack fa-lg position-absolute">
                    @if($leader->sex === 'F')
                        <i class="fa fa-circle fa-stack-2x text-danger"></i>
                        <i class="fa fa-venus fa-stack-1x fa-inverse"></i>
                    @else
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-mars fa-stack-1x fa-inverse"></i>
                    @endif
                </span>
            </div>
            <div class="m-auto w-50 text-white">{{ $leader->brief }}</div>
        </div>
    </div>

    <div class="container">
        <div class="py-4"><a href="{{ url('/') }}">首页</a> &gt; <a href="#">大咖领路</a> &gt; <span class="text-warning">领队详情</span></div>
    </div>

    <div class="container list-leader">
        <div class="bg-white p-5 ">
            <div class="media">
                <img class="mr-5" src="{{ imageCut(200, 200, $leader->avatar) }}" alt="{{ $leader->name }}" width="200" height="200">
                <div class="media-body">
                    <h4 class="text-warning">{{ $leader->name }}</h4>
                    <p class="text-warning text-justify">
                        <i class="fa fa-map-marker"></i>
                        <span class="mr-2">{{ $leader->country->name }}</span>
                        <span class="mr-2">{{ $leader->province->name }}</span>
                        <span class="mr-2">{{ $leader->city->name ?? ''}}</span>
                        <span class="mr-2">{{ $leader->district->name ?? '' }}</span>
                    </p>
                    <div class="small text-muted">{!! nl2br($leader->description) !!}</div>
                </div>
            </div>
        </div>

        <div class="d-flex my-5">
            <div style="color: #CCCCCC;"><i class="fa fa-quote-left fa-3x fa-pull-left"></i></div>
            <div class="text-justify text-muted">{!! nl2br($leader->introduction) !!}</div>
            <div style="color: #CCCCCC;" class="align-self-end"><i class="fa fa-quote-right fa-3x fa-pull-right"></i></div>
        </div>
    </div>

    <div class="container mb-5">
        <div id="leader" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                @foreach(collect($leader->photos)->chunk(3) as $chunk)
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                        <div class="row">
                            @foreach ($chunk as $photo)
                                <div class="col-4"><img class="d-block w-100" src="{{ imageCut(380, 300, $photo) }}" alt="展示图 {{ $loop->iteration }}"></div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#leader" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#leader" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

    <div class="container">
        <div class="bg-white p-5">
            <h3 class="text-warning mb-4"><i class="fa fa-fw fa-flag-o"></i> TA领队的活动</h3>
            <div class="row">
                <div class="col">
                    <div class="card">
                        <a href=""><img class="card-img-top" src="{{ asset('uploads/d/goods_like_1.jpg') }}" alt="Card image cap"></a>
                        <div class="card-body">
                            <p>
                                <a href="#" class="card-title">
                                    <span class="text-danger font-weight-bold">跟团游</span>
                                    泰国普吉岛7晚5日游(2晚离岛蓝湾泳池别墅...
                                </a>
                            </p>
                            <p class="card-text">
                                <span class="text-danger font-weight-bold lead">¥3600</span>
                                <small>起</small>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <a href=""><img class="card-img-top" src="{{ asset('uploads/d/goods_like_1.jpg') }}" alt="Card image cap"></a>
                        <div class="card-body">
                             <p>
                                <a href="#" class="card-title">
                                    <span class="text-danger font-weight-bold">跟团游</span>
                                    泰国普吉岛7晚5日游(2晚离岛蓝湾泳池别墅...
                                </a>
                            </p>
                            <p class="card-text">
                                <span class="text-danger font-weight-bold lead">¥3600</span>
                                <small>起</small>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <a href=""><img class="card-img-top" src="{{ asset('uploads/d/goods_like_1.jpg') }}" alt="Card image cap"></a>
                        <div class="card-body">
                             <p>
                                <a href="#" class="card-title">
                                    <span class="text-danger font-weight-bold">跟团游</span>
                                    泰国普吉岛7晚5日游(2晚离岛蓝湾泳池别墅...
                                </a>
                            </p>
                            <p class="card-text">
                                <span class="text-danger font-weight-bold lead">¥3600</span>
                                <small>起</small>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <a href=""><img class="card-img-top" src="{{ asset('uploads/d/goods_like_1.jpg') }}" alt="Card image cap"></a>
                        <div class="card-body">
                             <p>
                                <a href="#" class="card-title">
                                    <span class="text-danger font-weight-bold">跟团游</span>
                                    泰国普吉岛7晚5日游(2晚离岛蓝湾泳池别墅...
                                </a>
                            </p>
                            <p class="card-text">
                                <span class="text-danger font-weight-bold lead">¥3600</span>
                                <small>起</small>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-4 text-center">
                <a href="#" class="btn btn-outline-warning">更多活动</a>
            </div>
        </div>
    </div>
@endsection