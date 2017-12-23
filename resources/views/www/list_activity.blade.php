@extends('layouts.app')

@section('title', '活动')

@section('content')
    <div class="container">
        <div id="banner" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#banner" data-slide-to="0" class="active"></li>
                <li data-target="#banner" data-slide-to="1"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{ asset('uploads/d/list_banner_goods_1.jpg') }}" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('uploads/d/list_banner_goods_1.jpg') }}" alt="Second slide">
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="py-4"><a href="{{ url('/') }}">首页</a> &gt; @isset($nav)<span>{{ $nav->text }}</span> &gt;@endisset <span class="text-warning">活动</span></div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-8" id="load">
                <div class="bg-white mb-2 py-3 list-param">
                    <div class="row px-3">
                        <div class="col-1 text-nowrap">区域</div>
                        <div class="col-10 text-truncate">
                            <a href="{{ route('www.activity.list', Request::only('nid')) }}" @empty(request('pid')) class="active" @endempty>全部</a>
                            @foreach($provinces as $province)
                                <a href="{{ route('www.activity.list', array_merge(Request::only('nid'), ['pid' => $province])) }}" @if(request('pid') == $province->id) class="active" @endif>{{ $province->name }}</a>
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
                            <a href="{{ route('www.activity.list', Request::only('nid', 'pid')) }}" @empty(request('cid')) class="active" @endempty>全部</a>
                            @foreach($cities as $city)
                                <a href="{{ route('www.activity.list', array_merge(Request::only('nid', 'pid'), ['cid' => $city])) }}" @if(request('cid') == $city->id) class="active" @endif>{{ $city->name }}</a>
                            @endforeach
                        </div>
                        @if(count($cities) >= 12)
                            <div class="col-1 text-nowrap">
                                <span class="text-warning">更多 <i class="fa fa-angle-down"></i></span>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="bg-white pb-3 list-param">
                    <div class="row px-3">
                        <div class="col-1 text-nowrap">价格</div>
                        <div class="col-10 text-truncate">
                            <a href="{{ route('www.activity.list', Request::only('nid', 'pid', 'cid')) }}" @empty(request('price')) class="active" @endempty>全部</a>
                            <a href="{{ route('www.activity.list', array_merge(Request::only('nid', 'pid', 'cid'), ['price[max]' => 499])) }}" @if(Request::input('price.max') == 499) class="active" @endif>500元以下</a>
                            <a href="{{ route('www.activity.list', array_merge(Request::only('nid', 'pid', 'cid'), ['price[min]' => 500, 'price[max]' => 999])) }}" @if(Request::input('price.max') == 1000) class="active" @endif>500-999元</a>
                            <a href="{{ route('www.activity.list', array_merge(Request::only('nid', 'pid', 'cid'), ['price[min]' => 1000, 'price[max]' => 1999])) }}" @if(Request::input('price.max') == 2000) class="active" @endif>1000-1999元</a>
                            <a href="{{ route('www.activity.list', array_merge(Request::only('nid', 'pid', 'cid'), ['price[min]' => 2000, 'price[max]' => 5000])) }}" @if(Request::input('price.max') == 2000) class="active" @endif>2000-5000元</a>
                            <a href="{{ route('www.activity.list', array_merge(Request::only('nid', 'pid', 'cid'), ['price[min]' => 5001])) }}" @if(Request::input('price.min') == 1001) class="active" @endif>5000以上</a>
                        </div>
                    </div>
                </div>

                <div class="bg-white list-orderBy py-2 my-2">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link {{ request('field', 'id') === 'id' ? 'active' : '' }}" href="{{ route('www.activity.list', array_merge(Request::only('nid', 'pid', 'cid', 'price'), ['field' => 'id', 'order' => request('field', 'id') == 'id' &&  request('order', 'desc') === 'desc' ? 'asc' : 'desc'])) }}">综合排序 <i class="fa fa-angle-{{  request('field', 'id') === 'id' && request('order', 'desc') === 'desc' ? 'down' : 'up' }}"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request('field') === 'price' ? 'active' : '' }}" href="{{ route('www.activity.list', array_merge(Request::only('nid', 'pid', 'cid', 'price'), ['field' => 'price', 'order' => request('field') == 'price' &&  request('order') === 'desc' ? 'asc' : 'desc'])) }}">价格 <i class="fa fa-angle-{{  request('field') == 'price' && request('order') === 'desc' ? 'down' : 'up' }}"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request('field') === 'created_at' ? 'active' : '' }}" href="{{ route('www.activity.list', array_merge(Request::only('nid', 'pid', 'cid', 'price'), ['field' => 'created_at', 'order' => request('field') == 'created_at' &&  request('order') === 'desc' ? 'asc' : 'desc'])) }}">发布时间 <i class="fa fa-angle-{{ request('field') == 'created_at' &&  request('order') === 'desc' ? 'down' : 'up' }}"></i></a>
                        </li>
                    </ul>
                </div>

                <div class="bg-white p-3 my-2 list-media">
                    @foreach($activities as $activity)
                        <div class="media">
                            <div class="mr-3 position-relative">
                                <a href="{{ route('www.activity.show', $activity) }}" target="_blank">
                                    <img src="{{ imageCut(280, 180, $activity->thumb) }}" alt="{{ $activity->short }}" width="280" height="180">
                                </a>
                                <span class="bg-warning text-white text-center p-1 position-absolute day">
                                    <b>{{ $activity->trips_count }}</b>
                                    <br>DAY
                                </span>
                            </div>
                            <div class="media-body">
                                <a href="{{ route('www.activity.show', $activity) }}" class="text-warning d-block" target="_blank">
                                    <h3>{{ str_limit($activity->short, 30) }}</h3>
                                    <h5>{{ str_limit($activity->title, 80) }}</h5>
                                </a>
                                <p class="pt-2">
                                    <span class="text-info pr-3">行程</span>
                                    {{ str_limit($activity->xc, 90) }}
                                </p>
                                <p class="text-muted">
                                    <small>{{ str_limit($activity->description, 200) }}</small>
                                </p>
                                <h5 class="d-flex justify-content-between">
                                    <a href="javascript:void(0);" class="btn-fatuan text-info">出团日期 <i class="fa fa-lg fa-caret-down"></i></a>
                                    <span>￥{{ $activity->price }}/人</span>
                                </h5>
                                <div class="list-fatuan d-none">
                                    <table class="table text-nowrap">
                                        @foreach($activity->tuans as $tuan)
                                            <tr>
                                                <td class="align-middle">{{ $tuan->start_time->toDateString() }} - {{ $tuan->end_time->toDateString() }}</td>
                                                <td class="align-middle text-muted">已报名 {{ $tuan->start_num }} 人</td>
                                                <td class="align-middle text-danger">{{ $tuan->price }}元/人</td>
                                                <td class="align-middle text-right pr-3">
                                                    @if($tuan->available())
                                                        <a href="#{{ $tuan->id }}" class="btn btn-warning text-white btn-sm rounded-0">去报名</a>
                                                    @elseif($tuan->remainder() <= 0)
                                                        <a href="javascript:void(0);" class="btn btn-warning text-white btn-sm rounded-0 disabled">已满员</a>
                                                    @else
                                                        <a href="javascript:void(0);" class="btn btn-warning text-white btn-sm rounded-0 disabled">已结束</a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <nav class="d-flex justify-content-end pt-5 w-100">
                        {{ $activities->appends(Request::only('nid', 'pid', 'cid', 'field', 'order'))->links() }}
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
    <link href="https://cdn.bootcss.com/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css" rel="stylesheet">
    <script src="https://cdn.bootcss.com/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.js"></script>
    <script>
        (function ($) {
            // 筛选 显示更多
            $('#load').on('click', '.list-param span', function () {
                $(this).children().toggleClass('fa-flip-vertical')
                $(this).parent().prev().toggleClass('text-truncate')
            })

            // 显示发团日期
            $('#load').on('click', 'a.btn-fatuan', function () {
                $(this).children().toggleClass('fa-flip-vertical')
                $(this).closest('div').find('.list-fatuan').toggleClass('d-none').mCustomScrollbar()
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