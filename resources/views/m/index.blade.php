@extends('layouts.m')

@section('title', '首页')

@section('content')
    <header class="position-absolute">
        <div class="text-white d-flex justify-content-between">
            <a href="/"><img src="{{ asset('m/img/logo_white.png') }}" alt="logo" width="86" height="27"></a>
            <div>
                <a href="auth/login.html">
                    <i class="fa fa-fw fa-user"></i>
                    <!--<img class="rounded-circle" src="img/avatar.png" alt="avatar" width="22" height="22">-->
                </a>
                <a href="#menu" data-toggle="collapse">
                    <i class="fa fa-fw fa-align-justify"></i>
                </a>
            </div>
        </div>
    </header>

    <nav class="collapse font-weight-light position-absolute" id="menu">
        <a href="#">纵横西部</a>
        <a href="#">微上西部</a>
        <a href="#">超级周末</a>
        <a href="#">最6旅行</a>
        <a href="#">定制游</a>
        <a href="#">活动</a>
        <a href="#">攻略</a>
        <a href="#">游记</a>
        <a href="#">大咖领路</a>
        <a href="#">旅拍直播</a>
        <a href="#">关于我们</a>
    </nav>

    <form class="position-absolute" autocomplete="off" id="index-search">
        <div class="input-group">
            <div class="input-group-btn">
                <button type="button" id="search-btn" class="btn dropdown-toggle down bg-none index-search-btn" data-toggle="dropdown">不限</button>
                <div class="dropdown-menu rounded-0" style="background: rgba(255,255,255, .8); min-width: auto;">
                    <a class="dropdown-item search-item" href="javascript:void(0);">不限</a>
                    <a class="dropdown-item search-item" href="javascript:void(0);" pid="2">北京</a>
                    <a class="dropdown-item search-item" href="javascript:void(0);" pid="2283">四川</a>
                    <a class="dropdown-item search-item" href="javascript:void(0);" pid="2584">云南</a>
                    <a class="dropdown-item search-item" href="javascript:void(0);" pid="2730">西藏</a>
                    <a class="dropdown-item search-item" href="javascript:void(0);" pid="3031">青海</a>
                    <a class="dropdown-item search-item" href="javascript:void(0);" pid="3111">新疆</a>
                    <a class="dropdown-item search-item" href="javascript:void(0);" pid="3277">爱尔巴桑</a>
                    <a class="dropdown-item search-item" href="javascript:void(0);" pid="3339">赫拉特</a>
                    <a class="dropdown-item search-item" href="javascript:void(0);" pid="3471">安道尔城</a>
                    <a class="dropdown-item search-item" href="javascript:void(0);" pid="3500">北部地区</a>
                    <a class="dropdown-item search-item" href="javascript:void(0);" pid="5777">北海道</a>
                </div>
            </div>
            <input type="hidden" name="pid" id="pid">
            <input type="text" class="form-control bg-none index-q" name="q" id="q" placeholder="搜目的地/攻略/游记">
            <button type="submit" class="input-group-addon bg-none"><i class="fa fa-search text-white fa-lg"></i></button>
        </div>
    </form>

    <section class="position-absolute text-center font-weight-light text-truncate small" id="index-nav">
        <a href="#"><img src="{{ asset('m/img/nav_1.png') }}" alt="纵横西部"> 纵横西部</a>
        <a href="#"><img src="{{ asset('m/img/nav_2.png') }}" alt="纵横西部"> 微上西部</a>
        <a href="#"><img src="{{ asset('m/img/nav_3.png') }}" alt="纵横西部"> 超级周末</a>
        <a href="#"><img src="{{ asset('m/img/nav_4.png') }}" alt="纵横西部"> 最6旅行</a>
        <a href="#"><img src="{{ asset('m/img/nav_5.png') }}" alt="纵横西部"> 定制旅行</a>
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
                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{ asset('m/img/line_1.png') }}" alt="First slide">
                    <div class="carousel-caption">
                        <h5>西藏6天5晚自由行</h5>
                        <small class="pl-3">五星度假，蜜月游圣地</small>
                    </div>
                    <div class="position-absolute btn-see">
                        <small class="text-white d-block">¥<strong class="lead">6424</strong>起</small>
                        <a href="#" class="btn btn-sm btn-block btn-outline-light">去看看</a>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('m/img/line_1.png') }}" alt="Third slide">
                    <div class="carousel-caption">
                        <h5>西藏6天5晚自由行</h5>
                        <small class="pl-3">五星度假，蜜月游圣地</small>
                    </div>
                    <div class="position-absolute btn-see">
                        <small class="text-white d-block">¥<strong class="lead">6424</strong>起</small>
                        <a href="#" class="btn btn-sm btn-block btn-outline-light">去看看</a>
                    </div>
                </div>
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
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="{{ asset('m/img/wan_1.png') }}" alt="First slide">
                            <div class="carousel-caption">
                                <h5>活动 · 这个周末带你玩成都</h5>
                                <small class="pl-3">我们不做周末宅</small>
                            </div>
                            <div class="position-absolute btn-see">
                                <a href="#" class="btn btn-sm btn-block btn-outline-light">去看看</a>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{ asset('m/img/wan_1.png') }}" alt="Third slide">
                            <div class="carousel-caption">
                                <h5>活动 · 这个周末带你玩成都</h5>
                                <small class="pl-3">我们不做周末宅</small>
                            </div>
                            <div class="position-absolute btn-see">
                                <a href="#" class="btn btn-sm btn-block btn-outline-light">去看看</a>
                            </div>
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
            <div class="tab-pane fade" id="leader">
                <div id="leaders" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <dl class="row p-2">
                                <dt class="col-5">
                                    <a href="#"><img class="rounded-circle img-fluid" src="{{ asset('m/img/avatar_leader.png') }}" alt="avatar_leader"></a>
                                </dt>
                                <dd class="col-7 text-justify">
                                    <h5 class="text-warning pl-2" style="border-left: 2px solid #FF9900; margin-left: -0.7rem;">领队 · 橘子</h5>
                                    <small class="text-secondary">从业十六年，多次带队走过全国三十余省，经历了旅游由量变到质变的过程、坚守为客户提供最佳的旅行方案，回归真正的旅行。</small>
                                </dd>
                            </dl>
                        </div>
                        <div class="carousel-item">
                            <dl class="row p-2">
                                <dt class="col-5">
                                    <a href="#"><img class="rounded-circle img-fluid" src="{{ asset('m/img/avatar_leader.png') }}" alt="avatar_leader"></a>
                                </dt>
                                <dd class="col-7 text-justify">
                                    <h5 class="text-warning pl-2" style="border-left: 2px solid #FF9900; margin-left: -0.7rem;">领队 · 橘子</h5>
                                    <small class="text-secondary">从业十六年，多次带队走过全国三十余省，经历了旅游由量变到质变的过程、坚守为客户提供最佳的旅行方案，回归真正的旅行。</small>
                                </dd>
                            </dl>
                        </div>
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
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="{{ asset('m/img/wan_1.png') }}" alt="First slide">
                            <div class="carousel-caption">
                                <h5>丽江 · 花间堂客栈</h5>
                                <small class="pl-3">特色民宿七折火爆预定中</small>
                            </div>
                            <div class="position-absolute btn-see">
                                <a href="#" class="btn btn-sm btn-block btn-outline-light">去看看</a>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{ asset('m/img/wan_1.png') }}" alt="Third slide">
                            <div class="carousel-caption">
                                <h5>丽江 · 花间堂客栈</h5>
                                <small class="pl-3">特色民宿七折火爆预定中</small>
                            </div>
                            <div class="position-absolute btn-see">
                                <a href="#" class="btn btn-sm btn-block btn-outline-light">去看看</a>
                            </div>
                        </div>
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
            <a href="#" class="w-50 float-left pr-1 position-relative text-white">
                <img src="{{ asset('m/img/raider.png') }}" alt="raider" class="img-fluid">
                <div class="position-absolute">
                    <p class="mb-1"><i class="far fa-lg fa-compass"></i></p>
                    <h6 class="mb-0">旅游攻略</h6>
                    <small>美食 · 景点 · 线路 · 酒店</small>
                </div>
            </a>
            <a href="#" class="w-50 float-right pl-1 position-relative text-white">
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
                        <li data-target="#films" data-slide-to="0" class="active"></li>
                        <li data-target="#films" data-slide-to="1"></li>
                        <li data-target="#films" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="{{ asset('m/img/video.png') }}" alt="video">
                            <div class="carousel-caption">
                                <p class="text-center"><i class="fab fa-3x fa-youtube"></i></p>
                                周末成都超级火锅带你探秘
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{ asset('m/img/video.png') }}" alt="video">
                            <div class="carousel-caption">
                                <p class="text-center"><i class="fab fa-3x fa-youtube"></i></p>
                                周末成都超级火锅带你探秘
                            </div>
                        </div>
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
                        <li data-target="#lives" data-slide-to="0" class="active"></li>
                        <li data-target="#lives" data-slide-to="1"></li>
                        <li data-target="#lives" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="{{ asset('m/img/video.png') }}" alt="video">
                            <div class="carousel-caption">
                                <p class="text-center"><i class="fab fa-3x fa-youtube"></i></p>
                                周末成都超级火锅带你探秘
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{ asset('m/img/video.png') }}" alt="video">
                            <div class="carousel-caption">
                                <p class="text-center"><i class="fab fa-3x fa-youtube"></i></p>
                                周末成都超级火锅带你探秘
                            </div>
                        </div>
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
        <ul class="nav nav-justified nav-two mb-3 flex-nowrap text-nowrap">
            <li class="nav-item">
                <a class="nav-link px-1 active" data-toggle="tab" href="#nav_1">纵横西部</a>
            </li>
            <li class="nav-item">
                <a class="nav-link px-1" data-toggle="tab" href="#nav_2">微上西部</a>
            </li>
            <li class="nav-item">
                <a class="nav-link px-1" data-toggle="tab" href="#nav_3">超级周末</a>
            </li>
            <li class="nav-item">
                <a class="nav-link px-1" data-toggle="tab" href="#nav_4">最6旅行</a>
            </li>
        </ul>

        <div class="tab-content slide-two">
            <div class="tab-pane fade show active" id="nav_1">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{ asset('m/img/line_1.png') }}" alt="First slide">
                    <div class="carousel-caption">
                        <h5>西藏 · 6天5晚自由行</h5>
                        <small class="pl-3">五星度假，蜜月游圣地</small>
                    </div>
                    <div class="position-absolute btn-see">
                        <small class="text-white d-block">¥<strong class="lead">6424</strong>起</small>
                        <a href="#" class="btn btn-sm btn-block btn-outline-light">去看看</a>
                    </div>
                </div>
                <p class="text-right mb-0 p-2 font-weight-light">
                    <a href="#" class="text-secondary"><i class="fa fa-fw fa-angle-right"></i>更多西藏</a>
                </p>

                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{ asset('m/img/line_2.png') }}" alt="Third slide">
                    <div class="carousel-caption">
                        <h5>新疆 · 北疆6天5晚自由行</h5>
                        <small class="pl-3">五星度假，蜜月游圣地</small>
                    </div>
                    <div class="position-absolute btn-see">
                        <small class="text-white d-block">¥<strong class="lead">6424</strong>起</small>
                        <a href="#" class="btn btn-sm btn-block btn-outline-light">去看看</a>
                    </div>
                </div>
                <p class="text-right mb-0 p-2 font-weight-light">
                    <a href="#" class="text-secondary"><i class="fa fa-fw fa-angle-right"></i>更多新疆</a>
                </p>

                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{ asset('m/img/line_3.png') }}" alt="Third slide">
                    <div class="carousel-caption">
                        <h5>新疆 · 北疆6天5晚自由行</h5>
                        <small class="pl-3">五星度假，蜜月游圣地</small>
                    </div>
                    <div class="position-absolute btn-see">
                        <small class="text-white d-block">¥<strong class="lead">6424</strong>起</small>
                        <a href="#" class="btn btn-sm btn-block btn-outline-light">去看看</a>
                    </div>
                </div>
                <p class="text-right mb-0 p-2 font-weight-light">
                    <a href="#" class="text-secondary"><i class="fa fa-fw fa-angle-right"></i>更多新疆</a>
                </p>
            </div>
            <div class="tab-pane fade" id="nav_2">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{ asset('m/img/line_3.png') }}" alt="Third slide">
                    <div class="carousel-caption">
                        <h5>新疆 · 北疆6天5晚自由行</h5>
                        <small class="pl-3">五星度假，蜜月游圣地</small>
                    </div>
                    <div class="position-absolute btn-see">
                        <small class="text-white d-block">¥<strong class="lead">6424</strong>起</small>
                        <a href="#" class="btn btn-sm btn-block btn-outline-light">去看看</a>
                    </div>
                </div>
                <p class="text-right mb-0 p-2 font-weight-light">
                    <a href="#" class="text-secondary"><i class="fa fa-fw fa-angle-right"></i>更多新疆</a>
                </p>

                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{ asset('m/img/line_1.png') }}" alt="First slide">
                    <div class="carousel-caption">
                        <h5>西藏 · 6天5晚自由行</h5>
                        <small class="pl-3">五星度假，蜜月游圣地</small>
                    </div>
                    <div class="position-absolute btn-see">
                        <small class="text-white d-block">¥<strong class="lead">6424</strong>起</small>
                        <a href="#" class="btn btn-sm btn-block btn-outline-light">去看看</a>
                    </div>
                </div>
                <p class="text-right mb-0 p-2 font-weight-light">
                    <a href="#" class="text-secondary"><i class="fa fa-fw fa-angle-right"></i>更多西藏</a>
                </p>

                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{ asset('m/img/line_2.png') }}" alt="Third slide">
                    <div class="carousel-caption">
                        <h5>新疆 · 北疆6天5晚自由行</h5>
                        <small class="pl-3">五星度假，蜜月游圣地</small>
                    </div>
                    <div class="position-absolute btn-see">
                        <small class="text-white d-block">¥<strong class="lead">6424</strong>起</small>
                        <a href="#" class="btn btn-sm btn-block btn-outline-light">去看看</a>
                    </div>
                </div>
                <p class="text-right mb-0 p-2 font-weight-light">
                    <a href="#" class="text-secondary"><i class="fa fa-fw fa-angle-right"></i>更多新疆</a>
                </p>
            </div>

            <div class="tab-pane fade show" id="nav_3">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{ asset('m/img/line_1.png') }}" alt="First slide">
                    <div class="carousel-caption">
                        <h5>西藏 · 6天5晚自由行</h5>
                        <small class="pl-3">五星度假，蜜月游圣地</small>
                    </div>
                    <div class="position-absolute btn-see">
                        <small class="text-white d-block">¥<strong class="lead">6424</strong>起</small>
                        <a href="#" class="btn btn-sm btn-block btn-outline-light">去看看</a>
                    </div>
                </div>
                <p class="text-right mb-0 p-2 font-weight-light">
                    <a href="#" class="text-secondary"><i class="fa fa-fw fa-angle-right"></i>更多西藏</a>
                </p>

                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{ asset('m/img/line_2.png') }}" alt="Third slide">
                    <div class="carousel-caption">
                        <h5>新疆 · 北疆6天5晚自由行</h5>
                        <small class="pl-3">五星度假，蜜月游圣地</small>
                    </div>
                    <div class="position-absolute btn-see">
                        <small class="text-white d-block">¥<strong class="lead">6424</strong>起</small>
                        <a href="#" class="btn btn-sm btn-block btn-outline-light">去看看</a>
                    </div>
                </div>
                <p class="text-right mb-0 p-2 font-weight-light">
                    <a href="#" class="text-secondary"><i class="fa fa-fw fa-angle-right"></i>更多新疆</a>
                </p>

                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{ asset('m/img/line_3.png') }}" alt="Third slide">
                    <div class="carousel-caption">
                        <h5>新疆 · 北疆6天5晚自由行</h5>
                        <small class="pl-3">五星度假，蜜月游圣地</small>
                    </div>
                    <div class="position-absolute btn-see">
                        <small class="text-white d-block">¥<strong class="lead">6424</strong>起</small>
                        <a href="#" class="btn btn-sm btn-block btn-outline-light">去看看</a>
                    </div>
                </div>
                <p class="text-right mb-0 p-2 font-weight-light">
                    <a href="#" class="text-secondary"><i class="fa fa-fw fa-angle-right"></i>更多新疆</a>
                </p>
            </div>
            <div class="tab-pane fade" id="nav_4">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{ asset('m/img/line_3.png') }}" alt="Third slide">
                    <div class="carousel-caption">
                        <h5>新疆 · 北疆6天5晚自由行</h5>
                        <small class="pl-3">五星度假，蜜月游圣地</small>
                    </div>
                    <div class="position-absolute btn-see">
                        <small class="text-white d-block">¥<strong class="lead">6424</strong>起</small>
                        <a href="#" class="btn btn-sm btn-block btn-outline-light">去看看</a>
                    </div>
                </div>
                <p class="text-right mb-0 p-2 font-weight-light">
                    <a href="#" class="text-secondary"><i class="fa fa-fw fa-angle-right"></i>更多新疆</a>
                </p>

                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{ asset('m/img/line_1.png') }}" alt="First slide">
                    <div class="carousel-caption">
                        <h5>西藏 · 6天5晚自由行</h5>
                        <small class="pl-3">五星度假，蜜月游圣地</small>
                    </div>
                    <div class="position-absolute btn-see">
                        <small class="text-white d-block">¥<strong class="lead">6424</strong>起</small>
                        <a href="#" class="btn btn-sm btn-block btn-outline-light">去看看</a>
                    </div>
                </div>
                <p class="text-right mb-0 p-2 font-weight-light">
                    <a href="#" class="text-secondary"><i class="fa fa-fw fa-angle-right"></i>更多西藏</a>
                </p>

                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{ asset('m/img/line_2.png') }}" alt="Third slide">
                    <div class="carousel-caption">
                        <h5>新疆 · 北疆6天5晚自由行</h5>
                        <small class="pl-3">五星度假，蜜月游圣地</small>
                    </div>
                    <div class="position-absolute btn-see">
                        <small class="text-white d-block">¥<strong class="lead">6424</strong>起</small>
                        <a href="#" class="btn btn-sm btn-block btn-outline-light">去看看</a>
                    </div>
                </div>
                <p class="text-right mb-0 p-2 font-weight-light">
                    <a href="#" class="text-secondary"><i class="fa fa-fw fa-angle-right"></i>更多新疆</a>
                </p>
            </div>
            <p class="text-center text-secondary small">
                <i class="fas fa-sync fa-spin"></i> 更多精彩加载中...
            </p>
        </div>
    </div>
@endsection