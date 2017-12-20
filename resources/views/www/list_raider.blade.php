@extends('layouts.app')

@section('title', '游玩攻略_路线攻略_美食攻略_住宿攻略_景点攻略')

@section('content')
    <div class="container">
        <div class="py-4"><a href="{{ url('/') }}">首页</a> &gt; <span class="text-warning">攻略</span></div>
    </div>

    <div class="container mb-4 page-list-box">
        <div class="d-flex flex-wrap justify-content-between types">
            <a href="{{ route('www.raider.list') }}" class="position-relative">
                <img src="{{ asset('img/list_raiders.jpg') }}" alt="攻略列表">
                <div class="text-center position-absolute">
                    <h3>全部攻略</h3>
                    <p class="lead">玩吃住行，出行无忧</p>
                    <i class="fa fa-fw fa-3x fa-book"></i>
                </div>
            </a>
            <a href="{{ route('www.raider.list', ['type' => 'line']) }}" class="position-relative">
                <img src="{{ asset('img/list_line.jpg') }}" alt="list_line">
                <div class="text-center position-absolute">
                    <h3>线路攻略</h3>
                    <p class="lead">随心纯玩新模式</p>
                    <i class="fa fa-fw fa-3x fa-map"></i>
                </div>
            </a>
            <a href="{{ route('www.raider.list', ['type' => 'food']) }}" class="position-relative">
                <img src="{{ asset('img/list_food.jpg') }}" alt="list_food">
                <div class="text-center position-absolute">
                    <h3>美食攻略</h3>
                    <p class="lead">一路美食相伴</p>
                    <i class="fa fa-fw fa-3x fa-birthday-cake"></i>
                </div>
            </a>

            <a href="{{ route('www.raider.list', ['type' => 'default']) }}" class="position-relative">
                <img src="{{ asset('img/list_youhui.jpg') }}" alt="更多优惠活动">
                <div class="text-center position-absolute">
                    <h3>更多优惠活动</h3>
                    <p class="lead">2018年预约启程</p>
                    <i class="fa fa-fw fa-3x fa-plane"></i>
                </div>
            </a>
            <a href="{{ route('www.raider.list', ['type' => 'hospital']) }}" class="position-relative">
                <img src="{{ asset('img/list_hotel.jpg') }}" alt="住宿攻略">
                <div class="text-center position-absolute">
                    <h3>住宿攻略</h3>
                    <p class="lead">旅居当地，特色民宿</p>
                    <i class="fa fa-fw fa-3x fa-hospital-o"></i>
                </div>
            </a>
            <a href="{{ route('www.raider.list', ['type' => 'scenic']) }}" class="position-relative">
                <img src="{{ asset('img/list_scenic.jpg') }}" alt="景点攻略">
                <div class="text-center position-absolute">
                    <h3>景点攻略</h3>
                    <p class="lead">深度挖掘，好玩有趣</p>
                    <i class="fa fa-fw fa-3x fa-camera"></i>
                </div>
            </a>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-8" id="load">
                <div class="bg-white mb-2 py-3 list-param">
                    <div class="row px-3">
                        <div class="col-1 text-nowrap">区域</div>
                        <div class="col-10 text-truncate">
                            <a href="{{ route('www.raider.list', Request::only('type')) }}" @empty(request('pid')) class="active" @endempty>全部</a>
                            @foreach($provinces as $qu)
                                <a href="{{ route('www.raider.list', array_merge(Request::only('type'), ['pid' => $qu])) }}" @if(request('pid') == $qu->id) class="active" @endif>{{ $qu->name }}</a>
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
                            <a href="{{ route('www.raider.list', Request::only('type', 'pid')) }}" @empty(request('cid')) class="active" @endempty>全部</a>
                            @foreach($citys as $cy)
                                <a href="{{ route('www.raider.list', array_merge(Request::only('type', 'pid'), ['cid' => $cy])) }}" @if(request('cid') == $cy->id) class="active" @endif>{{ $cy->name }}</a>
                            @endforeach
                        </div>
                        @if(count($citys) >= 12)
                            <div class="col-1 text-nowrap">
                                <span class="text-warning">更多 <i class="fa fa-angle-down"></i></span>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="bg-white list-orderBy py-2 my-2">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link {{ request('field', 'id') === 'id' ? 'active' : '' }}" href="{{ route('www.raider.list', array_merge(Request::only('type', 'pid', 'cid'), ['field' => 'id', 'order' => request('field', 'id') == 'id' &&  request('order') === 'desc' ? 'asc' : 'desc'])) }}">综合排序 <i class="fa fa-angle-{{  request('field', 'id') === 'id' && request('order', 'desc') === 'desc' ? 'down' : 'up' }}"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request('field') === 'click' ? 'active' : '' }}" href="{{ route('www.raider.list', array_merge(Request::only('type', 'pid', 'cid'), ['field' => 'click', 'order' => request('field') == 'click' &&  request('order') === 'desc' ? 'asc' : 'desc'])) }}">热门度 <i class="fa fa-angle-{{  request('field') == 'click' && request('order') === 'desc' ? 'down' : 'up' }}"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request('field') === 'created_at' ? 'active' : '' }}" href="{{ route('www.raider.list', array_merge(Request::only('type', 'pid', 'cid'), ['field' => 'created_at', 'order' => request('field') == 'created_at' &&  request('order') === 'desc' ? 'asc' : 'desc'])) }}">发布时间 <i class="fa fa-angle-{{ request('field') == 'created_at' &&  request('order') === 'desc' ? 'down' : 'up' }}"></i></a>
                        </li>
                    </ul>
                </div>

                <div class="bg-white p-3 my-2 list-media">
                    @foreach($raiders as $raider)
                        <div class="media">
                            @if($raider->thumb)
                                <a href="{{ route('www.raider.show', $raider) }}">
                                    <img class="mr-3" src="{{ imageCut(280, 180, $raider->thumb) }}" alt="{{ $raider->short }}" width="280" height="180">
                                </a>
                            @endif
                            <div class="media-body">
                                <a href="{{ route('www.raider.show', $raider) }}" class="text-warning d-block">
                                    <h3>{{ $raider->typeText() }} · {{ str_limit($raider->short, 26) }}</h3>
                                    <h5>{{ $raider->title }}</h5>
                                </a>
                                <p class="text-muted">
                                    <small>{{ str_limit($raider->description, 200) }}</small>
                                </p>
                                <p class="text-muted small">
                                    <span class="mr-3">
                                        <i class="fa fa-fw fa-map-marker"></i>{{ $raider->country->name }} {{ $raider->province->name }} {{ $raider->city->name ?? '' }}
                                    </span>

                                    <span class="mr-3"><i class="fa fa-fw fa-eye"></i>{{ $raider->click }}</span>
                                    <span class="mr-3"><i class="fa fa-fw fa-thumbs-o-up"></i>{{ $raider->likes_count }}</span>
                                    <span class="mr-3"><i class="fa fa-fw fa-clock-o"></i>{{ $raider->created_at->toDateString() }}</span>
                                </p>
                            </div>
                        </div>
                    @endforeach

                    <nav class="d-flex justify-content-end pt-5 w-100">
                        {{ $raiders->links() }}
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
                    <div class="text-warning">精彩游记</div>
                    <hr>

                    <a href="#"><img src="{{ asset('uploads/d/list_2.jpg') }}" alt="list_2" class="img-fluid"></a>
                    <p class="px-4 py-2">骨灰级成都吃货地图，天啊再也没有哪比成都的馆子多了，24小时都能满足你的胃</p>

                    <a href="#"><img src="{{ asset('uploads/d/list_2.jpg') }}" alt="list_2" class="img-fluid"></a>
                    <p class="px-4 py-2">骨灰级成都吃货地图，天啊再也没有哪比成都的馆子多了，24小时都能满足你的胃</p>

                    <a href="#"><img src="{{ asset('uploads/d/list_2.jpg') }}" alt="list_2" class="img-fluid"></a>
                    <p class="px-4 py-2">骨灰级成都吃货地图，天啊再也没有哪比成都的馆子多了，24小时都能满足你的胃</p>

                    <a class="row text-right" href="#">
                        <span class="col-10">有2361条相关游记</span>
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
            $('#load').on('click', '.list-param a, .list-orderBy a', function (event) {
                event.preventDefault()
                let url = $(this).attr('href') + ' #load > div'
                $('#load').load(url)
            })

            // 类别加载
            $('.types > a').click(function (event) {
                event.preventDefault()
                let url = $(this).attr('href') + ' #load > div'
                let title = $(this).find('h3').text()
                $('#load').load(url, function () {
                    swal(title, '当前类别已经加载完成！',"success")
                })
            })
        })(jQuery);
    </script>
@endpush
