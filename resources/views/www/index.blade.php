@extends('layouts.app')

@section('title', '首页')

@section('content')
    <div id="banner" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#banner" data-slide-to="0" class="active"></li>
            <li data-target="#banner" data-slide-to="1"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="{{ asset('uploads/d/banner_1.jpg') }}" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="{{ asset('uploads/d/banner_1.jpg') }}" alt="Second slide">
            </div>
        </div>
    </div>

    <section class="container p-5">
        <h4 class="text-center">遇途记 · 让旅行更简单 · 更好玩</h4>
        <h5 class="my-4 text-center">颠覆传统旅行模式，无导游，无购物，纯粹玩，资深旅行达人带您出发</h5>
        <div class="px-4 py-3 rounded m-auto" style="width: 630px; background: rgba(0,0,0, .2);">
            <p class="text-white hot-keywords">
                热搜：
                <a href="{{ route('search', ['q' => '西部']) }}" class="text-white mr-2" target="_blank">西部</a>
                <a href="{{ route('search', ['q' => '微旅行']) }}" class="text-white mr-2" target="_blank">微旅行</a>
                <a href="{{ route('search', ['q' => '成都']) }}" class="text-white mr-2" target="_blank">成都</a>
                <a href="{{ route('search', ['q' => '周末']) }}" class="text-white mr-2" target="_blank">周末</a>
                <a href="{{ route('search', ['q' => '一日游']) }}" class="text-white mr-2" target="_blank">一日游</a>
            </p>
            <form action="{{ route('search') }}" class="top-search" autocomplete="off">
                <div class="input-group">
                    <div class="input-group-btn">
                        <button type="button" id="search-btn" class="btn dropdown-toggle down bg-white" data-toggle="dropdown">不限</button>
                        <div class="dropdown-menu rounded-0 other-down no-line" style="background: rgba(255,255,255, .8)">
                            <a class="dropdown-item search-item" href="javascript:void(0);">不限</a>
                            @foreach($searchProvinces as $province)
                                <a class="dropdown-item search-item" href="javascript:void(0);" pid="{{ $province->id }}">{{ $province->name }}</a>
                            @endforeach
                        </div>
                    </div>
                    <input type="hidden" name="pid" id="pid">
                    <input type="text" class="form-control" name="q" id="q" placeholder="搜目的地/攻略/游记" style="border-right: none">
                    <button type="submit" class="input-group-addon submit bg-white"><i class="fa fa-search text-warning fa-lg"></i></button>
                </div>
            </form>
        </div>
    </section>

    <section class="container">
        <ul class="nav justify-content-center" role="tablist">
            @foreach($nav_tabs as $nav)
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#t{{ $loop->iteration }}" role="tab">{{ $nav->text }}</a>
                </li>
            @endforeach
        </ul>
        <div class="tab-content clearfix tab-theme my-4">
            {{--导航下活动循环数据--}}
            @foreach($nav_tabs as $nav)
                <div class="tab-pane fade" id="t{{ $loop->iteration }}">
                    @foreach($nav->activities as $activity)
                        <div class="position-relative float-left box {{ $loop->first ? 'active' : '' }}">
                            <img src="{{ imageCut(540, 340, $activity->thumb) }}" alt="{{ $activity->title }}" width="540" height="340">
                            <div class="position-absolute text text-white">
                                <h4 class="pl-3 text-truncate">{{ $activity->short }}</h4>
                                <p class="pl-3 text-truncate">{{ $activity->title }}</p>
                            </div>
                            <a href="{{ route('www.activity.show', $activity) }}" class="position-absolute btn btn-warning text-white" target="_blank">去看看</a>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </section>

    <section class="container py-3 wan-tbs">
        <div class="row">
            <div class="col-7">
                <ul class="nav mb-2" role="tablist" style="margin-left: -15px">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#wan" role="tab">别样玩法</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#di" role="tab">旅居当地</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="wan">
                        <div id="wans" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @foreach($wans as $raider)
                                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                        <img class="d-block" src="{{ imageCut(680, 340, $raider->thumb) }}" alt="{{ $raider->short }}">
                                        <div class="carousel-caption">
                                            <h4 class="pl-3">{{ $raider->short }}</h4>
                                            <p class="pl-3">{{ $raider->title }}</p>
                                        </div>
                                        <a href="{{ route('www.raider.show', $raider) }}" class="position-absolute btn btn-warning text-white" target="_blank">去看看</a>
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
                    <div class="tab-pane fade show" id="di">
                        <div id="dis" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @foreach($hospitals as $raider)
                                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                        <img class="d-block" src="{{ imageCut(680, 340, $raider->thumb) }}" alt="{{ $raider->short }}">
                                        <div class="carousel-caption">
                                            <h4 class="pl-3">{{ $raider->short }}</h4>
                                            <p class="pl-3">{{ $raider->title }}</p>
                                        </div>
                                        <a href="{{ route('www.raider.show', $raider) }}" class="position-absolute btn btn-warning text-white" target="_blank">去看看</a>
                                    </div>
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#dis" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#dis" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-5 pl-0">
                <div class="d-flex justify-content-between py-2 mb-2">
                    <span class="text-warning">大咖领路</span>
                    <a href="{{ route('www.leader.list') }}" class="text-muted">更多…</a>
                </div>
                <div class="d-flex justify-content-between">
                    @foreach($leaders as $leader)
                        <a href="{{ route('www.leader.show', $leader) }}" target="_blank"><img src="{{ imageCut(160, 340, $leader->avatar) }}" alt="{{ $leader->name }}" width="160" height="340"></a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <div class="container text-center py-5">
        <h4>超级周末 • 两天也能度个假</h4>
        <h5 class="mt-4">周末不死宅，重新发现身边小众又惊艳的新地方</h5>
    </div>
    <div id="lv_1" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#lv_1" data-slide-to="0" class="active"></li>
            <li data-target="#lv_1" data-slide-to="1"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="{{ asset('uploads/d/carousel_1_1.jpg') }}" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="{{ asset('uploads/d/carousel_1_1.jpg') }}" alt="Second slide">
            </div>
        </div>
    </div>

    <div class="container text-center py-5">
        <h4>微上西部 • 繁忙生活的小确幸</h4>
        <h5 class="mt-4">拼个假就出发，错开高峰避开人群，给自己放个假</h5>
    </div>
    <div id="lv_2" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#lv_2" data-slide-to="0" class="active"></li>
            <li data-target="#lv_2" data-slide-to="1"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="{{ asset('uploads/d/carousel_2_1.jpg') }}" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="{{ asset('uploads/d/carousel_2_1.jpg') }}" alt="Second slide">
            </div>
        </div>
    </div>

    <div class="container text-center py-5">
        <h4>纵横西部 • 中国很大西部很美</h4>
        <h5 class="mt-4">从河西走廊穿越新疆南北，从内蒙草原绵延彩云之南，从国道318抵达雪域之巅</h5>
    </div>
    <div id="lv_3" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#lv_3" data-slide-to="0" class="active"></li>
            <li data-target="#lv_3" data-slide-to="1"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="{{ asset('uploads/d/carousel_3_1.jpg') }}" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="{{ asset('uploads/d/carousel_3_1.jpg') }}" alt="Second slide">
            </div>
        </div>
    </div>

    <div class="container text-center py-5">
        <h4>最6旅行 • 专属主题旅行</h4>
        <h5 class="mt-4">主题活动，和志同道合的小伙伴一起疯玩儿</h5>
    </div>
    <div id="lv_4" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#lv_4" data-slide-to="0" class="active"></li>
            <li data-target="#lv_4" data-slide-to="1"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="{{ asset('uploads/d/carousel_4_1.jpg') }}" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="{{ asset('uploads/d/carousel_4_1.jpg') }}" alt="Second slide">
            </div>
        </div>
    </div>

    <div class="container my-5">
        <div class="row">
            <div class="col-6 pr-0">
                <ul class="nav mb-2" role="tablist" style="margin-left: -15px">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#vp" role="tab">旅途短拍</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#zb" role="tab">大咖直播</a>
                    </li>
                    <li class="nav-item ml-auto">
                        <a class="nav-link disabled" href="{{ route('www.video.list') }}">更多...</a>
                    </li>
                </ul>
                <div class="tab-content wan-video">
                    <div class="tab-pane fade show active" id="vp">
                        <div class="mb-2 position-relative">
                            @isset($films[0])
                                <a href="{{ route('www.video.show', $films[0]) }}" title="{{ $films[0]->title }}" target="_blank">
                                    <img src="{{ imageCut(600, 380, $films[0]->thumb) }}" alt="{{ $films[0]->title }}" width="600" height="380">
                                    <h5 class="position-absolute text text-truncate">{{ $films[0]->title }}</h5>
                                    <p class="position-absolute icon"><i class="fa fa-5x fa-play-circle-o"></i></p>
                                </a>
                            @endisset
                        </div>
                        <div class="d-flex justify-content-between">
                            @isset($films[1])
                                <a class="position-relative" href="{{ route('www.video.show', $films[1]) }}" title="{{ $films[1]->title }}" target="_blank">
                                    <img src="{{ imageCut(294, 186, $films[1]->thumb) }}" alt="{{ $films[1]->title }}" width="294" height="186">
                                    <h5 class="position-absolute text text-truncate">{{ $films[1]->title }}</h5>
                                    <p class="position-absolute icon"><i class="fa fa-3x fa-play-circle-o"></i></p>
                                </a>
                            @endisset
                            @isset($films[2])
                                <a class="position-relative" href="{{ route('www.video.show', $films[2]) }}" title="{{ $films[2]->title }}" target="_blank">
                                    <img src="{{ imageCut(294, 186, $films[2]->thumb) }}" alt="{{ $films[2]->title }}" width="294" height="186">
                                    <h5 class="position-absolute text text-truncate">{{ $films[2]->title }}</h5>
                                    <p class="position-absolute icon"><i class="fa fa-3x fa-play-circle-o"></i></p>
                                </a>
                            @endisset
                        </div>
                    </div>

                    <div class="tab-pane fade show" id="zb">
                        <div class="mb-2 position-relative">
                            @isset($lives[0])
                                <a href="{{ route('www.video.show', $lives[0]) }}" title="{{ $lives[0]->title }}" target="_blank">
                                    <img src="{{ imageCut(600, 380, $lives[0]->thumb) }}" alt="{{ $lives[0]->title }}" width="600" height="380">
                                    <h5 class="position-absolute text text-truncate">{{ $lives[0]->title }}</h5>
                                    <p class="position-absolute icon"><i class="fa fa-5x fa-play-circle-o"></i></p>
                                </a>
                            @endisset
                        </div>
                        <div class="d-flex justify-content-between">
                            @isset($lives[1])
                                <a class="position-relative" href="{{ route('www.video.show', $lives[1]) }}" title="{{ $lives[1]->title }}" target="_blank">
                                    <img src="{{ imageCut(294, 186, $lives[1]->thumb) }}" alt="{{ $lives[1]->title }}" width="294" height="186">
                                    <h5 class="position-absolute text text-truncate">{{ $lives[1]->title }}</h5>
                                    <p class="position-absolute icon"><i class="fa fa-3x fa-play-circle-o"></i></p>
                                </a>
                            @endisset
                            @isset($lives[2])
                                <a class="position-relative" href="{{ route('www.video.show', $lives[2]) }}" title="{{ $lives[2]->title }}" target="_blank">
                                    <img src="{{ imageCut(294, 186, $lives[2]->thumb) }}" alt="{{ $lives[2]->title }}" width="294" height="186">
                                    <h5 class="position-absolute text text-truncate">{{ $lives[2]->title }}</h5>
                                    <p class="position-absolute icon"><i class="fa fa-3x fa-play-circle-o"></i></p>
                                </a>
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <ul class="nav mb-2" role="tablist" style="margin-left: -10px">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#gl" role="tab">超强攻略</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#xl" role="tab">线路</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#jd" role="tab">景点</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#ms" role="tab">美食</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#msu" role="tab">民宿</a>
                    </li>
                    <li class="nav-item ml-auto">
                        <a class="nav-link disabled" href="{{  route('www.raider.list') }}">更多...</a>
                    </li>
                </ul>
                @php
                    $list_class = ['w-50 float-left pr-1 mb-2', 'w-50 float-right pl-1 mb-2', 'w-50 float-right pl-1', 'w-50 float-left pr-1 mb-2', 'w-50 float-left pr-1'];
                @endphp
                <div class="tab-content wan-gl clearfix">
                    <div class="tab-pane fade show active" id="gl">
                        @foreach($z_wans as $item)
                            <div class="{{ $list_class[$loop->index] }}">
                                <a href="{{ route('www.raider.show', $item) }}" class="position-relative d-block" title="{{ $item->title }}" target="_blank">
                                    <img src="{{ imageCut(286, $loop->index === 2 ? 378 : 186, $item->thumb) }}" alt="{{ $item->short }}" class="w-100" width="286" height="{{ $loop->index === 2 ? 378 : 186 }}">
                                    <h5 class="position-absolute text-truncate">{{ $item->short }}<br><i class="fa fa-2x fa-sign-in mt-3"></i></h5>
                                    <i class="position-absolute bg-mark"></i>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <div class="tab-pane fade" id="xl">
                        @foreach($z_lines as $item)
                            <div class="{{ $list_class[$loop->index] }}">
                                <a href="{{ route('www.raider.show', $item) }}" class="position-relative d-block" title="{{ $item->title }}" target="_blank">
                                    <img src="{{ imageCut(286, $loop->index === 2 ? 378 : 186, $item->thumb) }}" alt="{{ $item->short }}" class="w-100" width="286" height="{{ $loop->index === 2 ? 378 : 186 }}">
                                    <h5 class="position-absolute text-truncate">{{ $item->short }}<br><i class="fa fa-2x fa-sign-in mt-3"></i></h5>
                                    <i class="position-absolute bg-mark"></i>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <div class="tab-pane fade" id="jd">
                        @foreach($z_scenics as $item)
                            <div class="{{ $list_class[$loop->index] }}">
                                <a href="{{ route('www.raider.show', $item) }}" class="position-relative d-block" title="{{ $item->title }}" target="_blank">
                                    <img src="{{ imageCut(286, $loop->index === 2 ? 378 : 186, $item->thumb) }}" alt="{{ $item->short }}" class="w-100" width="286" height="{{ $loop->index === 2 ? 378 : 186 }}">
                                    <h5 class="position-absolute text-truncate">{{ $item->short }}<br><i class="fa fa-2x fa-sign-in mt-3"></i></h5>
                                    <i class="position-absolute bg-mark"></i>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <div class="tab-pane fade" id="ms">
                        @foreach($z_foods as $item)
                            <div class="{{ $list_class[$loop->index] }}">
                                <a href="{{ route('www.raider.show', $item) }}" class="position-relative d-block" title="{{ $item->title }}" target="_blank">
                                    <img src="{{ imageCut(286, $loop->index === 2 ? 378 : 186, $item->thumb) }}" alt="{{ $item->short }}" class="w-100" width="286" height="{{ $loop->index === 2 ? 378 : 186 }}">
                                    <h5 class="position-absolute text-truncate">{{ $item->short }}<br><i class="fa fa-2x fa-sign-in mt-3"></i></h5>
                                    <i class="position-absolute bg-mark"></i>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <div class="tab-pane fade" id="msu">
                        @foreach($z_hospitals as $item)
                            <div class="{{ $list_class[$loop->index] }}">
                                <a href="{{ route('www.raider.show', $item) }}" class="position-relative d-block" title="{{ $item->title }}" target="_blank">
                                    <img src="{{ imageCut(286, $loop->index === 2 ? 378 : 186, $item->thumb) }}" alt="{{ $item->short }}" class="w-100" width="286" height="{{ $loop->index === 2 ? 378 : 186 }}">
                                    <h5 class="position-absolute text-truncate">{{ $item->short }}<br><i class="fa fa-2x fa-sign-in mt-3"></i></h5>
                                    <i class="position-absolute bg-mark"></i>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="container list-youji mb-5">
        <div class="d-flex justify-content-between">
            <span class="h5 text-warning">精彩游记</span>
            <a href="{{ route('www.travel.list') }}" class="text-muted">更多...</a>
        </div>
        <div class="row" style="margin: 0 -0.25rem;">
            @foreach($travels as $travel)
                <div class="col-4 p-1">
                    <div class="p-2 bg-white media">
                        <a href="{{ route('www.travel.show', $travel) }}" target="_blank">
                            <img class="mr-3" src="{{ imageCut(168, 110, $travel->thumb) }}" width="168" height="110" alt="{{ $travel->title }}">
                        </a>
                        <div class="media-body">
                            <a href="{{ route('www.travel.show', $travel) }}" class="h6" target="_blank">{{ $travel->title }}</a>
                            <div class="d-flex justify-content-between">
                                <span>{{ $travel->created_at->toDateString() }}</span>
                                <span>BY</span>
                                <a href="{{ route('www.user.travel', $travel->user) }}" class="text-warning">{{ $travel->user->name }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <div>
        <a href="{{ url('customized') }}" target="_blank"><img src="{{ asset('img/dingzhi.jpg') }}" alt="dingzhi" class="img-fluid"></a>
    </div>
@endsection

@push('script')
    <script>
        (function ($) {
            // 鼠标经过切换效果
            $('.tab-theme .box').hover(function () {
                $(this).addClass('active').siblings().removeClass('active');
            })
        })(jQuery)
    </script>
@endpush