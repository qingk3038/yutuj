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
                            @foreach($provinces as $province)
                                <a href="{{ route('www.raider.list', array_merge(Request::only('type'), ['pid' => $province])) }}" @if(request('pid') == $province->id) class="active" @endif>{{ $province->name }}</a>
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
                            @foreach($cities as $city)
                                <a href="{{ route('www.raider.list', array_merge(Request::only('type', 'pid'), ['cid' => $city])) }}" @if(request('cid') == $city->id) class="active" @endif>{{ $city->name }}</a>
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
                            <a class="nav-link {{ request('field', 'id') === 'id' ? 'active' : '' }}" href="{{ route('www.raider.list', array_merge(Request::only('type', 'pid', 'cid'), ['field' => 'id', 'order' => request('field', 'id') == 'id' &&  request('order', 'desc') === 'desc' ? 'asc' : 'desc'])) }}">综合排序 <i class="fa fa-angle-{{  request('field', 'id') === 'id' && request('order', 'desc') === 'desc' ? 'down' : 'up' }}"></i></a>
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
                                <a href="{{ route('www.raider.show', $raider) }}" target="_blank">
                                    <img class="mr-3" src="{{ imageCut(280, 180, $raider->thumb) }}" alt="{{ $raider->short }}" width="280" height="180">
                                </a>
                            @endif
                            <div class="media-body">
                                <a href="{{ route('www.raider.show', $raider) }}" class="text-warning d-block" target="_blank">
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
                        {{ $raiders->appends(Request::only('type', 'pid', 'cid', 'field', 'order'))->links() }}
                    </nav>
                </div>
            </div>
            <div class="col-4 pl-0">
                @include('www.right')
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
            $(document).on('click', '.list-param a, .list-orderBy a, .types > a, ul.pagination a', function (event) {
                event.preventDefault()
                let url = $(this).attr('href') + ' #load > div'
                $('#load').load(url)
            })
        })(jQuery);
    </script>
@endpush
