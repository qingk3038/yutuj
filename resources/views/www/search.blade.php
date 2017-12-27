@extends('layouts.app')

@section('title', sprintf('搜索"%s"的结果', request('q')))

@section('content')
    <div class="container">
        <div class="py-4"><a href="{{ url('/') }}">首页</a> &gt; <span class="text-warning">{{ sprintf('搜索"%s"的结果', request('q')) }}</span></div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-8">
                <div class="bg-white p-3 mb-4">
                    <ul class="nav" style="margin-left: -15px;">
                        @foreach($navs as $nav)
                            <li class="nav-item">
                                <a href="#nav{{ $loop->iteration }}" data-toggle="tab" class="nav-link @if($loop->first) active @endif">
                                    {{ $nav->text }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <hr class="mt-0">
                    <div class="tab-content">
                        @foreach($navs as $nav)
                            <div class="list-media tab-pane fade show @if($loop->first) active @endif" id="nav{{ $loop->iteration }}">
                                @foreach($nav->activities as $activity)
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
                                        </div>
                                    </div>
                                @endforeach
                                <nav class="d-flex justify-content-end pt-5 w-100">
                                    {{ $nav->activities->links() }}
                                </nav>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="bg-white p-3 mb-4">
                    <ul class="nav" style="margin-left: -15px;">
                        @foreach($raider_types as $key => $type)
                            <li class="nav-item">
                                <a href="#raider_{{$key }}" data-toggle="tab" class="nav-link @if($loop->first) active @endif">
                                    {{ $type }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <hr class="mt-0">

                    <div class="tab-content">
                        @foreach($raider_types as $key => $type)
                            <div class="list-media tab-pane fade show @if($loop->first) active @endif" id="raider_{{ $key }}">
                                @foreach($raiders[$key] as $raider)
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
                                    {{ $raiders[$key]->links() }}
                                </nav>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="bg-white p-3 mb-4 list-media">
                    <ul class="nav" style="margin-left: -15px;">
                        <li class="nav-item">
                            <a href="javascript:void(0);" class="nav-link active">游记</a>
                        </li>
                    </ul>
                    <hr class="mt-0">
                    @foreach($travels as $travel)
                        <div class="media">
                            <a href="{{ route('www.travel.show', $travel) }}" target="_blank">
                                <img class="mr-3" src="{{ imageCut(280, 180, $travel->thumb) }}" alt="{{ $travel->title }}" width="280" height="180">
                            </a>
                            <div class="media-body">
                                <a href="{{ route('www.travel.show', $travel) }}" class="text-warning d-block h5" target="_blank">{{ str_limit($travel->title, 80) }}</a>
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
                        {{ $travels->links() }}
                    </nav>
                </div>

                <div class="bg-white p-3 mb-4 list-video">
                    <ul class="nav" style="margin-left: -15px;">
                        <li class="nav-item">
                            <a href="#films" data-toggle="tab" class="nav-link active">旅途短拍</a>
                        </li>
                        <li class="nav-item">
                            <a href="#live" data-toggle="tab" class="nav-link">大咖直播</a>
                        </li>
                    </ul>
                    <hr class="mt-0">
                    <div class="tab-content">
                        <div class="list-media tab-pane fade show active" id="films">
                            <div class="row" style="margin: 0 -5px;">
                                @foreach($films as $film)
                                    <a class="col-4 box" href="{{ route('www.video.show', $film) }}" title="{{ $film->title }}" target="_blank">
                                        <p class="position-relative">
                                            <img class="img-fluid" src="{{ imageCut(380, 214, $film->thumb) }}" alt="{{ $film->title }}" width="380" height="214">
                                            <i class="fa fa-2x fa-play-circle-o position-absolute"></i>
                                        </p>
                                        <h5>{{ $film->province->name }} · {{ str_limit($film->title, 12) }}</h5>
                                        <p class="small text-truncate pl-3">{{ str_limit($film->description) }}</p>
                                    </a>
                                @endforeach
                            </div>
                            <nav class="d-flex justify-content-end">
                                {{ $films->appends(['v' => 'film'])->links() }}
                            </nav>
                        </div>
                        <div class="list-media tab-pane fade" id="live">
                            <div class="row" style="margin: 0 -5px;">
                                @foreach($lives as $life)
                                    <a class="col-4 box" href="{{ route('www.video.show', $life) }}" title="{{ $life->title }}" target="_blank">
                                        <p class="position-relative">
                                            <img class="img-fluid" src="{{ imageCut(380, 214, $life->thumb) }}" alt="{{ $life->title }}" width="380" height="214">
                                            <i class="fa fa-2x fa-play-circle-o position-absolute"></i>
                                        </p>
                                        <h5>{{ $life->province->name }} · {{ str_limit($life->title, 12) }}</h5>
                                        <p class="small text-truncate pl-3">{{ str_limit($life->description) }}</p>
                                    </a>
                                @endforeach
                            </div>
                            <nav class="d-flex justify-content-end">
                                {{ $films->appends(['v' => 'live'])->links() }}
                            </nav>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-4 pl-0">
                @include('www.right')
            </div>
        </div>
    </div>
@endsection

@push('script')
    <link href="https://cdn.bootcss.com/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css"
          rel="stylesheet">
    <script src="https://cdn.bootcss.com/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.js"></script>
    <script>
        (function ($) {
            // 筛选 显示更多
            $('.list-param span').click(function () {
                $(this).children().toggleClass('fa-flip-vertical')
                $(this).parent().prev().toggleClass('text-truncate')
            })

            // 排序
            $('.list-orderBy a').click(function () {
                $(this).closest('.nav').find('a').removeClass('active')
                $(this).addClass('active')
                let fa = $(this).children()
                if (fa.css('opacity') === '1') {
                    fa.toggleClass('fa-flip-vertical')
                }
            })

            // 显示发团日期
            $('a.btn-fatuan').click(function () {
                $(this).children().toggleClass('fa-flip-vertical')
                $(this).closest('div').find('.list-fatuan').toggleClass('d-none').mCustomScrollbar()
            })
        })(jQuery);
    </script>
@endpush