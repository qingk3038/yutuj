@extends('layouts.app')

@section('title', $activity->title)

@section('content')
    <div class="container">
        <div class="py-4"><a href="">首页</a> &gt; <a href="{{ route('www.activity.list') }}">活动</a> &gt; <span class="text-warning">成都</span></div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col">
                <div id="photos" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @foreach($activity->photos as $photo)
                        <li data-target="#photos" data-slide-to="{{ $loop->index }}" @if($loop->first) class="active" @endif></li>
                        @endforeach
                    </ol>
                    <div class="carousel-inner">
                        @foreach($activity->photos as $photo)
                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                <img class="d-block w-100" src="{{ imageCut(585, 365, $photo) }}" alt="展示图 {{ $loop->iteration }}">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col bg-white pr-0 mr-3">
                <p class="text-muted small mt-4">产品编号：{{ $activity->number }}</p>
                <h4 class="my-3 text-truncate">{{ str_limit($activity->title, 46) }}</h4>
                <ul class="list-inline">
                    @php
                        $tag_btns = ['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark'];
                    @endphp
                    <li class="list-inline-item">
                        @foreach($activity->tags as $tag)
                            <span class="badge badge-{{ $tag_btns[mt_rand(0, 7)] }}">{{ $tag->text }}</span>
                        @endforeach
                    </li>
                    <li class="list-inline-item text-warning">
                        <i class="fa fa-map-marker"></i>
                        <span>{{ $activity->country->name }}</span>
                        <span>{{ $activity->province->name }}</span>
                        <span>{{ $activity->city->name ?? '' }}</span>
                        <span>{{ $activity->district->name ?? '' }}</span>
                    </li>
                </ul>
                <p class="font-weight-light" style="line-height: 2;">
                    产品类型：{{ $activity->types->pluck('text')->implode('、') }}
                    <br>游玩天数：{{ $activity->trips->count() }}天
                    <br>发团日期：每月多团
                    <br>出发地点：{{ $activity->cfd }}
                    <br>付款方式：支付宝、微信
                </p>

                @if($activity->closed)
                    <p class="lead text-danger"><i class="fa fa-fw fa-info-circle"></i>活动已被关闭。</p>
                @else
                    <p class="lead"><a href="javascript:void(0);" class="btn-fatuan">出团日期 <i class="fa fa-lg fa-caret-down"></i></a></p>
                    <div class="list-fatuan d-none">
                        <table class="table table-hover">
                            @foreach($activity->tuans as $tuan)
                                <tr>
                                    <td class="align-middle">{{ $tuan->start_time->toDateString() }} - {{ $tuan->end_time->toDateString() }}</td>
                                    <td class="align-middle text-muted">已报名 {{ $tuan->start_num + $tuan->usersOkCount() }} 人</td>
                                    <td class="align-middle text-danger">{{ $tuan->price }}元/人</td>
                                    <td class="align-middle text-right pr-3">
                                        @if($tuan->available())
                                            <a href="{{ route('pay.order.create', $tuan) }}" target="_blank" class="btn btn-warning text-white btn-sm rounded-0">去报名</a>
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
                @endif
            </div>
        </div>
    </div>

    <div class="container my-3">
        <div class="bg-white p-3" id="navbar">
            <ul class="nav goods-bar sticky-top bg-white">
                <li class="nav-item">
                    <a class="nav-link active" href="#ts">行程特色</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#ap">行程安排</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#fy">费用说明</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#zy">注意事项</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#qy">签约条款</a>
                </li>
            </ul>

            <div class="goods-list-box" id="ts">
                <h3 class="text-warning"><i class="fa fa-fw fa-camera-retro"></i> 行程特色</h3>
                <p class="text-muted d-block text-justify">
                    {!! nl2br($activity->ts) !!}
                </p>
                <p class="d-flex justify-content-between py-3">
                    @foreach($activity->tps as $tp)
                        <img src="{{ imageCut(330, 210, $tp) }}" alt="特色图 {{ $loop->iteration }}">
                    @endforeach
                </p>
            </div>

            <div class="goods-list-box" id="ap">
                <h3 class="text-warning"><i class="fa fa-fw fa-calendar"></i> 行程安排</h3>
                @foreach($activity->trips as $trip)
                    <h5 class="mt-4">
                        <span class="num-day">{{ $loop->iteration }}</span>
                        <strong class="pr-4 text-warning">第{{ numberToChinese($loop->iteration) }}天</strong>
                        {{ $trip->title }}
                    </h5>
                    <p class="pl-5 text-justify">
                        {!! nl2br($trip->body) !!}
                    </p>
                    <ul class="list-unstyled list-inline pl-5">
                        <li class="list-inline-item"><i class="iconfont icon-zaocan text-warning"></i> 早餐：{{ $trip->zaocan }}</li>
                        <li class="list-inline-item"><i class="iconfont icon-wucan text-warning"></i> 中餐：{{ $trip->wucan }}</li>
                        <li class="list-inline-item"><i class="iconfont icon-wancan text-warning"></i> 晚餐：{{ $trip->wancan }}</li>
                        <li class="list-inline-item"><i class="iconfont icon-zhusu text-warning"></i> 住宿：{{ $trip->zhusu }}</li>
                    </ul>
                    <div class="d-flex justify-content-between">
                        @if(is_array($trip->pictures))
                            @foreach($trip->pictures as $picture)
                                <img src="{{ imageCut(330, 210, $picture) }}" alt="行程安排 {{ $loop->iteration }}">
                            @endforeach
                        @endif
                    </div>
                @endforeach
            </div>
            <div class="goods-list-box" id="fy">
                <h3 class="text-warning"><i class="fa fa-fw fa-dollar"></i> 费用说明</h3>
                <p class="lead">费用包含</p>
                <div class="text-muted mb-3 text-justify">{!! nl2br($activity->baohan) !!}</div>

                <p class="lead">费用不含</p>
                <div class="text-muted text-justify">{!! nl2br($activity->buhan) !!}</div>
            </div>

            <div class="goods-list-box" id="zy">
                <h3 class="text-warning"><i class="fa fa-fw fa-file-text-o"></i> 注意事项</h3>
                <div class="text-muted text-justify">{!! nl2br($activity->zhuyi) !!}</div>
            </div>

            <div class="goods-list-box" id="qy">
                <h3 class="text-warning"><i class="fa fa-fw fa-edit"></i> 签约条款</h3>
                <div class="text-muted text-justify">{!! nl2br($activity->qianyue) !!}</div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="bg-white p-5">
            <h3 class="text-warning mb-4"><i class="fa fa-fw fa-flag-o"></i> 猜你喜欢</h3>
            <div class="row">
                @foreach($activities as $item)
                    <div class="col-3">
                        <div class="card">
                            <a href="{{ route('www.activity.show', $item) }}"><img class="card-img-top" src="{{ imageCut(255, 170, $item->thumb) }}" alt="{{ $item->short }}"></a>
                            <div class="card-body">
                                <p>
                                    <a href="{{ route('www.activity.show', $item) }}" class="card-title">
                                        <span class="text-danger font-weight-bold">{{ $item->types->first()->text }}</span>
                                        {{ str_limit($item->title, 36) }}
                                    </a>
                                </p>
                                <p class="card-text">
                                    <span class="text-danger font-weight-bold lead">¥{{ $item->price }}</span>
                                    <small>起</small>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@push('script')
    <link href="https://cdn.bootcss.com/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css" rel="stylesheet">
    <script src="https://cdn.bootcss.com/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.js"></script>
    <script>
        (function ($) {
            // 显示发团日期
            $('a.btn-fatuan').click(function () {
                $(this).children().toggleClass('fa-flip-vertical')
                $(this).closest('div').find('.list-fatuan').toggleClass('d-none').mCustomScrollbar()
            })

            // 滚动
            $('body').css('position', 'relative').scrollspy({target: '#navbar', offset: 100})

            $('#navbar a').click(function (event) {
                event.preventDefault();
                let id = $(this).attr('href');
                $('body,html').animate({scrollTop: $(id).offset().top - 50}, 1000);
            })
        })(jQuery);
    </script>
@endpush