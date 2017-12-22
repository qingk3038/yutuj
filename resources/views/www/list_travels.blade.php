@extends('layouts.app')

@section('title', '游记')

@section('content')
    <div class="container">
        <div id="banner" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#banner" data-slide-to="0" class="active"></li>
                <li data-target="#banner" data-slide-to="1"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{ asset('uploads/d/banner_travels_1.jpg') }}" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('uploads/d/banner_travels_1.jpg') }}" alt="Second slide">
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="py-4"><a href="{{ url('/') }}">首页</a> &gt; <span class="text-warning">游记</span></div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-8" id="load">
                <div class="bg-white mb-2 py-3 list-param">
                    <div class="row px-3">
                        <div class="col-1 text-nowrap">区域</div>
                        <div class="col-10 text-truncate">
                            <a href="{{ route('www.travel.list') }}" @empty(request('province'))class="active"@endempty>全部</a>
                            @foreach($provinces as $province)
                                <a href="{{ route('www.travel.list', ['province' => $province->title]) }}" @if(request('province') === $province->title) class="active" @endif>{{ $province->title }}</a>
                            @endforeach
                        </div>

                        @if(count($provinces) >= 12)
                            <div class="col-1 text-nowrap">
                                <span class="text-warning">更多 <i class="fa fa-angle-down"></i></span>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="bg-white py-3 list-param">
                    <div class="row px-3">
                        <div class="col-1 text-nowrap">目的地</div>
                        <div class="col-10 text-truncate">
                            <a href="{{ route('www.travel.list', Request::only('province')) }}" @empty(request('city'))class="active"@endempty>全部</a>
                            @foreach($cities as $city)
                                <a href="{{ route('www.travel.list', array_merge(Request::only('province'), ['city' => $city->title])) }}" @if(request('city') === $city->title)class="active"@endif>{{ $city->title }}</a>
                            @endforeach
                        </div>

                        @if(count($cities) >= 12)
                            <div class="col-1 text-nowrap">
                                <span class="text-warning">更多 <i class="fa fa-angle-down"></i></span>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="bg-white list-orderBy py-2 my-2">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link {{ request('field', 'id') === 'id' ? 'active' : '' }}" href="{{ route('www.travel.list', array_merge(Request::only('province', 'city'), ['field' => 'id', 'order' => request('field', 'id') == 'id' &&  request('order', 'desc') === 'desc' ? 'asc' : 'desc'])) }}">综合排序 <i class="fa fa-angle-{{  request('field', 'id') === 'id' && request('order', 'desc') === 'desc' ? 'down' : 'up' }}"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request('field') === 'click' ? 'active' : '' }}" href="{{ route('www.travel.list', array_merge(Request::only('province', 'city'), ['field' => 'click', 'order' => request('field') == 'click' &&  request('order') === 'desc' ? 'asc' : 'desc'])) }}">热门度 <i class="fa fa-angle-{{  request('field') == 'click' && request('order') === 'desc' ? 'down' : 'up' }}"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request('field') === 'created_at' ? 'active' : '' }}" href="{{ route('www.travel.list', array_merge(Request::only('province', 'city'), ['field' => 'created_at', 'order' => request('field') == 'created_at' &&  request('order') === 'desc' ? 'asc' : 'desc'])) }}">发布时间 <i class="fa fa-angle-{{ request('field') == 'created_at' &&  request('order') === 'desc' ? 'down' : 'up' }}"></i></a>
                        </li>
                    </ul>
                </div>

                <div class="bg-white p-3 my-2 list-media">
                    @foreach($travels as $travel)
                        <div class="media">
                            <a href="{{ route('www.travel.show', $travel) }}">
                                <img class="mr-3" src="{{ imageCut(280, 180, $travel->thumb) }}" alt="{{ $travel->title }}" width="280" height="180">
                            </a>
                            <div class="media-body">
                                <a href="{{ route('www.travel.show', $travel) }}" class="text-warning d-block h5">{{ str_limit($travel->title, 80) }}</a>
                                <p class="text-muted">
                                    <small>{{ str_limit($travel->description, 280) }}</small>
                                </p>
                                <p class="text-muted small">
                                    @if($travel->province)
                                        <span class="mr-3"><i class="fa fa-fw fa-map-marker"></i>{{ $travel->province }} {{ $travel->city }}</span>
                                    @endif
                                    <span class="mr-3"><i class="fa fa-fw fa-eye"></i>{{ $travel->click }}</span>
                                    <span class="mr-3"><i class="fa fa-fw fa-thumbs-o-up"></i>{{ $travel->likes_count }}</span>
                                    <span class="mr-3"><i class="fa fa-fw fa-user"></i>{{ $travel->user->name }}</span>
                                    <span class="mr-3"><i class="fa fa-fw fa-clock-o"></i>{{ $travel->created_at->toDateString() }}</span>
                                </p>
                            </div>
                        </div>
                    @endforeach

                    <nav class="d-flex justify-content-end pt-5 w-100">
                        {{ $travels->appends(Request::only( 'province', 'city', 'field', 'order'))->links() }}
                    </nav>
                </div>
            </div>
            <div class="col-4 pl-0">
                <div class="bg-white mb-4 p-3">
                    <ul class="nav" role="tablist">
                        <li class="nav-item" style="margin-left: -15px;">
                            <a class="nav-link active" data-toggle="tab" href="#vp" role="tab">旅行短拍</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#zb" role="tab">大咖直播</a>
                        </li>
                    </ul>
                    <hr class="mt-2">
                    <div class="tab-content clearfix wan-video">
                        <div class="tab-pane fade show active" id="vp">
                            <div class="mb-4 position-relative">
                                <a href="#">
                                    <img src="{{ asset('uploads/d/list_2.jpg') }}" alt="list_2" class="img-fluid">
                                    <h5 class="position-absolute text text-truncate">世界很小，相遇在路上，泸沽湖纪念 旅途的点点滴滴</h5>
                                    <p class="position-absolute icon"><i class="fa fa-5x fa-play-circle-o"></i></p>
                                </a>
                            </div>
                            <a class="row text-right" href="#">
                                <span class="col-10">有361条旅行短拍</span>
                                <span class="col-2"><i class="fa fa-angle-right text-warning"></i></span>
                            </a>
                        </div>
                        <div class="tab-pane fade" id="zb">
                            <div class="mb-4 position-relative">
                                <a href="#">
                                    <img src="{{ asset('uploads/d/list_2.jpg') }}" alt="list_2" class="img-fluid">
                                    <h5 class="position-absolute text text-truncate">世界很大，相遇在路上，泸沽湖纪念 旅途的点点滴滴</h5>
                                    <p class="position-absolute icon"><i class="fa fa-5x fa-play-circle-o"></i></p>
                                </a>
                            </div>
                            <a class="row text-right" href="#">
                                <span class="col-10">有2361条旅行短拍</span>
                                <span class="col-2"><i class="fa fa-angle-right text-warning"></i></span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="bg-white mb-4 p-3">
                    <div class="text-warning">推荐攻略</div>
                    <hr>

                    <a href="#"><img src="{{ asset('uploads/d/list_2.jpg') }}" alt="list_2" class="img-fluid"></a>
                    <p class="px-4 py-2">骨灰级成都吃货地图，天啊再也没有哪比成都的馆子多了，24小时都能满足你的胃</p>

                    <a href="#"><img src="{{ asset('uploads/d/list_2.jpg') }}" alt="list_2" class="img-fluid"></a>
                    <p class="px-4 py-2">骨灰级成都吃货地图，天啊再也没有哪比成都的馆子多了，24小时都能满足你的胃</p>

                    <a href="#"><img src="{{ asset('uploads/d/list_2.jpg') }}" alt="list_2" class="img-fluid"></a>
                    <p class="px-4 py-2">骨灰级成都吃货地图，天啊再也没有哪比成都的馆子多了，24小时都能满足你的胃</p>

                    <a class="row text-right" href="#">
                        <span class="col-10">有2361条相关攻略</span>
                        <span class="col-2"><i class="fa fa-angle-right text-warning"></i></span>
                    </a>
                </div>

                <div class="bg-white p-3">
                    <div class="text-warning">推荐活动</div>
                    <hr>

                    <a href="#"><img src="{{ asset('uploads/d/list_2.jpg') }}" alt="list_2" class="img-fluid"></a>
                    <p class="px-4 py-2">
                        <span class="float-right text-warning"><b>360</b>元起</span>
                        骨灰级成都吃货地图，天啊再也没有哪比成都的馆子多了
                    </p>


                    <a href="#"><img src="{{ asset('uploads/d/list_2.jpg') }}" alt="list_2" class="img-fluid"></a>
                    <p class="px-4 py-2">
                        <span class="float-right text-warning"><b>360</b>元起</span>
                        骨灰级成都吃货地图，天啊再也没有哪比成都的馆子多了
                    </p>

                    <a href="#"><img src="{{ asset('uploads/d/list_2.jpg') }}" alt="list_2" class="img-fluid"></a>
                    <p class="px-4 py-2">
                        <span class="float-right text-warning"><b>360</b>元起</span>
                        骨灰级成都吃货地图，天啊再也没有哪比成都的馆子多了
                    </p>

                    <a class="row text-right" href="#">
                        <span class="col-10">有2361条相关活动</span>
                        <span class="col-2"><i class="fa fa-angle-right text-warning"></i></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        (function ($) {
            // 筛选 显示更多
            $('#load').on('click', '.list-param span', function () {
                $(this).children().toggleClass('fa-flip-vertical')
                $(this).parent().prev().toggleClass('text-truncate')
            })

            // 异步加载
            $(document).on('click', '.list-param a, .list-orderBy a, ul.pagination a', function (event) {
                event.preventDefault()
                let url = $(this).attr('href') + ' #load > div'
                $('#load').load(url)
            })
        })(jQuery);
    </script>
@endpush