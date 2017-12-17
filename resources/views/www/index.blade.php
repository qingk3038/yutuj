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
            <p class="text-white">热搜：<a href="#" class="text-white mr-2">西部</a> <a href="#" class="text-white mr-2">微旅行</a> <a href="#" class="text-white mr-2">成都</a> <a href="#" class="text-white mr-2">周末</a> <a href="#" class="text-white mr-2">一日游</a></p>
            <form class="top-search">
                <div class="input-group">
                    <div class="input-group-btn">
                        <button type="button" class="btn dropdown-toggle down bg-white" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            四川
                        </button>
                        <div class="dropdown-menu rounded-0 other-down no-line" style="background: rgba(255,255,255, .8)">
                            <a class="dropdown-item" href="#">不限</a>
                            <a class="dropdown-item" href="#">四川</a>
                            <a class="dropdown-item" href="#">青海</a>
                            <a class="dropdown-item" href="#">西藏</a>
                            <a class="dropdown-item" href="#">新疆</a>
                            <a class="dropdown-item" href="#">内蒙古</a>
                            <a class="dropdown-item" href="#">陕甘宁</a>
                        </div>
                    </div>
                    <input type="text" class="form-control" placeholder="搜目的地/攻略/游记" style="border-right: none">
                    <button type="submit" class="input-group-addon submit bg-white"><i class="fa fa-search text-warning fa-lg"></i></button>
                </div>
            </form>
        </div>
    </section>

    <section class="container">
        <ul class="nav justify-content-center" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#t1" role="tab">热门线路</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#t2" role="tab">纵横西部</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#t3" role="tab">微上西部</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#t4" role="tab">超级周末</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#t5" role="tab">最6旅行</a>
            </li>
        </ul>
        <div class="tab-content clearfix tab-theme my-4">
            <div class="tab-pane fade show active" id="t1">
                @foreach($hot_line as $item)
                    <div class="position-relative float-left box {{ $loop->first ? 'active' : '' }}">
                        <img src="{{ Storage::url($item->thumb) }}" alt="{{ $item->title }}" width="540" height="340">
                        <div class="position-absolute text text-white">
                            <h4 class="pl-3 text-truncate">{{ $item->short }}</h4>
                            <p class="pl-3 text-truncate">{{ $item->title }}</p>
                        </div>
                        <a href="{{ route('activity.show', $item) }}" class="position-absolute btn btn-warning text-white">去看看</a>
                    </div>
                @endforeach
            </div>
            <div class="tab-pane fade" id="t2">
                <div class="position-relative float-left box active">
                    <img src="{{ asset('uploads/d/thumb_theme_1.jpg') }}" alt="thumb_theme_1" width="540" height="340">
                    <div class="position-absolute text text-white">
                        <h4 class="pl-3 text-truncate">西藏6天5晚自由行</h4>
                        <p class="pl-3 text-truncate">五星度假，蜜月游圣地</p>
                    </div>
                    <a href="#" class="position-absolute btn btn-warning text-white">去看看</a>
                </div>
                <div class="position-relative float-left box">
                    <img src="{{ asset('uploads/d/thumb_theme_2.jpg') }}" alt="thumb_theme_2" width="540" height="340">
                    <div class="position-absolute text text-white">
                        <h4 class="pl-3 text-truncate">活动 · 这个周末带你玩成都</h4>
                        <p class="pl-3 text-truncate">我们不做周末宅</p>
                    </div>
                    <a href="#" class="position-absolute btn btn-warning text-white">去看看</a>
                </div>
                <div class="position-relative float-left box">
                    <img src="{{ asset('uploads/d/thumb_theme_1.jpg') }}" alt="thumb_theme_1" width="540" height="340">
                    <div class="position-absolute text text-white">
                        <h4 class="pl-3 text-truncate">西藏6天5晚自由行</h4>
                        <p class="pl-3 text-truncate">五星度假，蜜月游圣地</p>
                    </div>
                    <a href="#" class="position-absolute btn btn-warning text-white">去看看</a>
                </div>
                <div class="position-relative float-left box">
                    <img src="{{ asset('uploads/d/thumb_theme_2.jpg') }}" alt="thumb_theme_2" width="540" height="340">
                    <div class="position-absolute text text-white">
                        <h4 class="pl-3 text-truncate">活动 · 这个周末带你玩成都</h4>
                        <p class="pl-3 text-truncate">我们不做周末宅</p>
                    </div>
                    <a href="#" class="position-absolute btn btn-warning text-white">去看看</a>
                </div>
            </div>
            <div class="tab-pane fade" id="t3">
                <div class="position-relative float-left box active">
                    <img src="{{ asset('uploads/d/thumb_theme_1.jpg') }}" alt="thumb_theme_1" width="540" height="340">
                    <div class="position-absolute text text-white">
                        <h4 class="pl-3 text-truncate">西藏6天5晚自由行</h4>
                        <p class="pl-3 text-truncate">五星度假，蜜月游圣地</p>
                    </div>
                    <a href="#" class="position-absolute btn btn-warning text-white">去看看</a>
                </div>
                <div class="position-relative float-left box">
                    <img src="{{ asset('uploads/d/thumb_theme_2.jpg') }}" alt="thumb_theme_2" width="540" height="340">
                    <div class="position-absolute text text-white">
                        <h4 class="pl-3 text-truncate">活动 · 这个周末带你玩成都</h4>
                        <p class="pl-3 text-truncate">我们不做周末宅</p>
                    </div>
                    <a href="#" class="position-absolute btn btn-warning text-white">去看看</a>
                </div>
                <div class="position-relative float-left box">
                    <img src="{{ asset('uploads/d/thumb_theme_1.jpg') }}" alt="thumb_theme_1" width="540" height="340">
                    <div class="position-absolute text text-white">
                        <h4 class="pl-3 text-truncate">西藏6天5晚自由行</h4>
                        <p class="pl-3 text-truncate">五星度假，蜜月游圣地</p>
                    </div>
                    <a href="#" class="position-absolute btn btn-warning text-white">去看看</a>
                </div>
                <div class="position-relative float-left box">
                    <img src="{{ asset('uploads/d/thumb_theme_2.jpg') }}" alt="thumb_theme_2" width="540" height="340">
                    <div class="position-absolute text text-white">
                        <h4 class="pl-3 text-truncate">活动 · 这个周末带你玩成都</h4>
                        <p class="pl-3 text-truncate">我们不做周末宅</p>
                    </div>
                    <a href="#" class="position-absolute btn btn-warning text-white">去看看</a>
                </div>
            </div>
            <div class="tab-pane fade" id="t4">
                <div class="position-relative float-left box active">
                    <img src="{{ asset('uploads/d/thumb_theme_1.jpg') }}" alt="thumb_theme_1" width="540" height="340">
                    <div class="position-absolute text text-white">
                        <h4 class="pl-3 text-truncate">西藏6天5晚自由行</h4>
                        <p class="pl-3 text-truncate">五星度假，蜜月游圣地</p>
                    </div>
                    <a href="#" class="position-absolute btn btn-warning text-white">去看看</a>
                </div>
                <div class="position-relative float-left box">
                    <img src="{{ asset('uploads/d/thumb_theme_2.jpg') }}" alt="thumb_theme_2" width="540" height="340">
                    <div class="position-absolute text text-white">
                        <h4 class="pl-3 text-truncate">活动 · 这个周末带你玩成都</h4>
                        <p class="pl-3 text-truncate">我们不做周末宅</p>
                    </div>
                    <a href="#" class="position-absolute btn btn-warning text-white">去看看</a>
                </div>
                <div class="position-relative float-left box">
                    <img src="{{ asset('uploads/d/thumb_theme_1.jpg') }}" alt="thumb_theme_1" width="540" height="340">
                    <div class="position-absolute text text-white">
                        <h4 class="pl-3 text-truncate">西藏6天5晚自由行</h4>
                        <p class="pl-3 text-truncate">五星度假，蜜月游圣地</p>
                    </div>
                    <a href="#" class="position-absolute btn btn-warning text-white">去看看</a>
                </div>
                <div class="position-relative float-left box">
                    <img src="{{ asset('uploads/d/thumb_theme_2.jpg') }}" alt="thumb_theme_2" width="540" height="340">
                    <div class="position-absolute text text-white">
                        <h4 class="pl-3 text-truncate">活动 · 这个周末带你玩成都</h4>
                        <p class="pl-3 text-truncate">我们不做周末宅</p>
                    </div>
                    <a href="#" class="position-absolute btn btn-warning text-white">去看看</a>
                </div>
            </div>
            <div class="tab-pane fade" id="t5">
                <div class="position-relative float-left box active">
                    <img src="{{ asset('uploads/d/thumb_theme_1.jpg') }}" alt="thumb_theme_1" width="540" height="340">
                    <div class="position-absolute text text-white">
                        <h4 class="pl-3 text-truncate">西藏6天5晚自由行</h4>
                        <p class="pl-3 text-truncate">五星度假，蜜月游圣地</p>
                    </div>
                    <a href="#" class="position-absolute btn btn-warning text-white">去看看</a>
                </div>
                <div class="position-relative float-left box">
                    <img src="{{ asset('uploads/d/thumb_theme_2.jpg') }}" alt="thumb_theme_2" width="540" height="340">
                    <div class="position-absolute text text-white">
                        <h4 class="pl-3 text-truncate">活动 · 这个周末带你玩成都</h4>
                        <p class="pl-3 text-truncate">我们不做周末宅</p>
                    </div>
                    <a href="#" class="position-absolute btn btn-warning text-white">去看看</a>
                </div>
                <div class="position-relative float-left box">
                    <img src="{{ asset('uploads/d/thumb_theme_1.jpg') }}" alt="thumb_theme_1" width="540" height="340">
                    <div class="position-absolute text text-white">
                        <h4 class="pl-3 text-truncate">西藏6天5晚自由行</h4>
                        <p class="pl-3 text-truncate">五星度假，蜜月游圣地</p>
                    </div>
                    <a href="#" class="position-absolute btn btn-warning text-white">去看看</a>
                </div>
                <div class="position-relative float-left box">
                    <img src="{{ asset('uploads/d/thumb_theme_2.jpg') }}" alt="thumb_theme_2" width="540" height="340">
                    <div class="position-absolute text text-white">
                        <h4 class="pl-3 text-truncate">活动 · 这个周末带你玩成都</h4>
                        <p class="pl-3 text-truncate">我们不做周末宅</p>
                    </div>
                    <a href="#" class="position-absolute btn btn-warning text-white">去看看</a>
                </div>
            </div>
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
                                <div class="carousel-item active">
                                    <img class="d-block" src="{{ asset('uploads/d/thumb_wan_1.jpg') }}" alt="First slide">
                                    <div class="carousel-caption">
                                        <h4 class="pl-3">活动 · 这个周末带你玩成都</h4>
                                        <p class="pl-3">我们不做周末宅</p>
                                    </div>
                                    <a href="#" class="position-absolute btn btn-warning text-white">去看看</a>
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block" src="{{ asset('uploads/d/thumb_wan_1.jpg') }}" alt="Second slide">
                                    <div class="carousel-caption">
                                        <h4 class="pl-3">活动 · 这个周末带你玩成都</h4>
                                        <p class="pl-3">我们不做周末宅</p>
                                    </div>
                                    <a href="#" class="position-absolute btn btn-warning text-white">去看看</a>
                                </div>
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
                                <div class="carousel-item active">
                                    <img class="d-block" src="{{ asset('uploads/d/thumb_wan_1.jpg') }}" alt="First slide">
                                    <div class="carousel-caption">
                                        <h4 class="pl-3">活动 · 这个周末带你玩成都</h4>
                                        <p class="pl-3">我们不做周末宅</p>
                                    </div>
                                    <a href="#" class="position-absolute btn btn-warning text-white">去看看</a>
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block" src="{{ asset('uploads/d/thumb_wan_1.jpg') }}" alt="Second slide">
                                    <div class="carousel-caption">
                                        <h4 class="pl-3">活动 · 这个周末带你玩成都</h4>
                                        <p class="pl-3">我们不做周末宅</p>
                                    </div>
                                    <a href="#" class="position-absolute btn btn-warning text-white">去看看</a>
                                </div>
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
                    <a href="#" class="text-muted">更多…</a>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="#"><img src="{{ asset('uploads/d/leader_1.jpg') }}" alt="leader_1" width="160" height="340"></a>
                    <a href="#"><img src="{{ asset('uploads/d/leader_2.jpg') }}" alt="leader_2" width="160" height="340"></a>
                    <a href="#"><img src="{{ asset('uploads/d/leader_3.jpg') }}" alt="leader_3" width="160" height="340"></a>
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
            <div class="col">
                <ul class="nav mb-2" role="tablist" style="margin-left: -15px">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#vp" role="tab">旅途短拍</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#zb" role="tab">大咖直播</a>
                    </li>
                    <li class="nav-item ml-auto">
                        <a class="nav-link disabled" href="javascript:void(0);">更多...</a>
                    </li>
                </ul>

                <div class="tab-content wan-video">
                    <div class="tab-pane fade show active" id="vp">
                        <div class="mb-2 position-relative">
                            <a href="#">
                                <img src="{{ asset('uploads/d/thumb_zb_1.jpg') }}" alt="thumb_zb_1">
                                <h5 class="position-absolute text text-truncate">世界很小，相遇在路上，泸沽湖纪念 旅途的点点滴滴</h5>
                                <p class="position-absolute icon"><i class="fa fa-5x fa-play-circle-o"></i></p>
                            </a>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a class="position-relative">
                                <img src="{{ asset('uploads/d/thumb_zb_2.jpg') }}" alt="thumb_zb_2">
                                <h5 class="position-absolute text text-truncate">世界很小，相遇在路上，泸沽湖纪念 旅途的点点滴滴</h5>
                                <p class="position-absolute icon"><i class="fa fa-3x fa-play-circle-o"></i></p>
                            </a>
                            <a class="position-relative">
                                <img src="{{ asset('uploads/d/thumb_zb_3.jpg') }}" alt="thumb_zb_3">
                                <h5 class="position-absolute text text-truncate">珠峰大本营留念2017</h5>
                                <p class="position-absolute icon"><i class="fa fa-3x fa-play-circle-o"></i></p>
                            </a>
                        </div>
                    </div>
                    <div class="tab-pane fade show" id="zb">
                        <div class="mb-2 position-relative">
                            <a href="#">
                                <img src="{{ asset('uploads/d/thumb_zb_1.jpg') }}" alt="thumb_zb_1">
                                <h5 class="position-absolute text text-truncate">世界很小，相遇在路上，泸沽湖纪念 旅途的点点滴滴</h5>
                                <p class="position-absolute icon"><i class="fa fa-5x fa-play-circle-o"></i></p>
                            </a>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a class="position-relative">
                                <img src="{{ asset('uploads/d/thumb_zb_3.jpg') }}" alt="thumb_zb_2">
                                <h5 class="position-absolute text text-truncate">世界很小，相遇在路上，泸沽湖纪念 旅途的点点滴滴</h5>
                                <p class="position-absolute icon"><i class="fa fa-3x fa-play-circle-o"></i></p>
                            </a>
                            <a class="position-relative">
                                <img src="{{ asset('uploads/d/thumb_zb_2.jpg') }}" alt="thumb_zb_3">
                                <h5 class="position-absolute text text-truncate">珠峰大本营留念2017</h5>
                                <p class="position-absolute icon"><i class="fa fa-3x fa-play-circle-o"></i></p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
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
                        <a class="nav-link disabled" href="javascript:void(0);">更多...</a>
                    </li>
                </ul>
                <div class="tab-content wan-gl clearfix">
                    <div class="tab-pane fade show active" id="gl">
                        <div class="w-50 float-left pr-1 mb-2">
                            <a href="#" class="position-relative d-block">
                                <img src="{{ asset('uploads/d/thumb_gl_1.jpg') }}" alt="thumb_gl_1" class="w-100">
                                <h5 class="position-absolute text-truncate">拉萨甜茶有5种吃法,你知道吗？ <br><i class="fa fa-2x fa-sign-in mt-3"></i></h5>
                                <i class="position-absolute bg-mark"></i>
                            </a>
                        </div>
                        <div class="w-50 float-right pl-1 mb-2">
                            <a href="#" class="position-relative d-block">
                                <img src="{{ asset('uploads/d/thumb_gl_1.jpg') }}" alt="thumb_zb_2" class="w-100">
                                <h5 class="position-absolute text-truncate">拉萨甜茶有5种吃法,你知道吗？ <br><i class="fa fa-2x fa-sign-in mt-3"></i></h5>
                                <i class="position-absolute bg-mark"></i>
                            </a>
                        </div>
                        <div class="w-50 float-right pl-1">
                            <a href="#" class="position-relative d-block">
                                <img src="uploads/d/thumb_gl_4.jpg" alt="thumb_gl_4" class="w-100">
                                <h5 class="position-absolute text-truncate">拉萨甜茶有5种吃法,你知道吗？ <br><i class="fa fa-2x fa-sign-in mt-3"></i></h5>
                                <i class="position-absolute bg-mark"></i>
                            </a>
                        </div>
                        <div class="w-50 float-left pr-1 mb-2">
                            <a href="#" class="position-relative d-block">
                                <img src="{{ asset('uploads/d/thumb_gl_1.jpg') }}" alt="thumb_zb_2" class="w-100">
                                <h5 class="position-absolute text-truncate">拉萨甜茶有5种吃法,你知道吗？ <br><i class="fa fa-2x fa-sign-in mt-3"></i></h5>
                                <i class="position-absolute bg-mark"></i>
                            </a>
                        </div>
                        <div class="w-50 float-left pr-1">
                            <a href="#" class="position-relative d-block">
                                <img src="{{ asset('uploads/d/thumb_gl_1.jpg') }}" alt="thumb_zb_2" class="w-100">
                                <h5 class="position-absolute text-truncate">拉萨甜茶有5种吃法,你知道吗？ <br><i class="fa fa-2x fa-sign-in mt-3"></i></h5>
                                <i class="position-absolute bg-mark"></i>
                            </a>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="xl">

                    </div>
                    <div class="tab-pane fade" id="jd">

                    </div>
                    <div class="tab-pane fade" id="ms">

                    </div>
                    <div class="tab-pane fade" id="msu">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="container list-youji mb-5">
        <div class="d-flex justify-content-between">
            <span class="h5 text-warning">精彩游记</span>
            <a href="#" class="text-muted">更多...</a>
        </div>
        <div class="row" style="margin: 0 -0.25rem;">
            <div class="col-4 p-1">
                <div class="p-2 bg-white media">
                    <a href="#"><img class="mr-3" src="{{ asset('uploads/d/thumb_y.jpg') }}" width="168" height="110" alt="Generic placeholder image"></a>
                    <div class="media-body">
                        <a href="#" class="h6">带上父母游云南，有你们在的地方都充满着快乐!</a>
                        <div class="d-flex justify-content-between">
                            <span>2017.11.22</span>
                            <span>BY</span>
                            <a href="#" class="text-warning">大鲨鱼</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4 p-1">
                <div class="p-2 bg-white media">
                    <a href="#"><img class="mr-3" src="{{ asset('uploads/d/thumb_y.jpg') }}" width="168" height="110" alt="Generic placeholder image"></a>
                    <div class="media-body">
                        <a href="#" class="h6">带上父母游云南，有你们在的地方都充满着快乐!</a>
                        <div class="d-flex justify-content-between">
                            <span>2017.11.22</span>
                            <span>BY</span>
                            <a href="#" class="text-warning">大鲨鱼</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4 p-1">
                <div class="p-2 bg-white media">
                    <a href="#"><img class="mr-3" src="{{ asset('uploads/d/thumb_y.jpg') }}" width="168" height="110" alt="Generic placeholder image"></a>
                    <div class="media-body">
                        <a href="#" class="h6">带上父母游云南，有你们在的地方都充满着快乐!</a>
                        <div class="d-flex justify-content-between">
                            <span>2017.11.22</span>
                            <span>BY</span>
                            <a href="#" class="text-warning">大鲨鱼</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4 p-1">
                <div class="p-2 bg-white media">
                    <a href="#"><img class="mr-3" src="{{ asset('uploads/d/thumb_y.jpg') }}" width="168" height="110" alt="Generic placeholder image"></a>
                    <div class="media-body">
                        <a href="#" class="h6">带上父母游云南，有你们在的地方都充满着快乐!</a>
                        <div class="d-flex justify-content-between">
                            <span>2017.11.22</span>
                            <span>BY</span>
                            <a href="#" class="text-warning">大鲨鱼</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4 p-1">
                <div class="p-2 bg-white media">
                    <a href="#"><img class="mr-3" src="{{ asset('uploads/d/thumb_y.jpg') }}" width="168" height="110" alt="Generic placeholder image"></a>
                    <div class="media-body">
                        <a href="#" class="h6">带上父母游云南，有你们在的地方都充满着快乐!</a>
                        <div class="d-flex justify-content-between">
                            <span>2017.11.22</span>
                            <span>BY</span>
                            <a href="#" class="text-warning">大鲨鱼</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4 p-1">
                <div class="p-2 bg-white media">
                    <a href="#"><img class="mr-3" src="{{ asset('uploads/d/thumb_y.jpg') }}" width="168" height="110" alt="Generic placeholder image"></a>
                    <div class="media-body">
                        <a href="#" class="h6">带上父母游云南，有你们在的地方都充满着快乐!</a>
                        <div class="d-flex justify-content-between">
                            <span>2017.11.22</span>
                            <span>BY</span>
                            <a href="#" class="text-warning">大鲨鱼</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div>
        <a href="{{ url('customized') }}"><img src="{{ asset('img/dingzhi.jpg') }}" alt="dingzhi" class="img-fluid"></a>
    </div>
@endsection

@push('script')
    <script>
        // 搜索栏下方切换
        $(document).ready(function () {
            $('.tab-theme .box').hover(function () {
                $(this).addClass('active').siblings().removeClass('active');
            })
        })
    </script>
@endpush