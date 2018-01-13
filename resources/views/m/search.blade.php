@extends('layouts.m')

@section('title', '搜索')

@section('header')
    @include('m.header', ['title' => '搜索', 'theme' => 'white'])
@endsection

@section('content')
<form autocomplete="off" id="index-search" class="mt-5">
    <div class="input-group">
        <div class="input-group-btn">
            <button type="button" id="search-btn" class="btn dropdown-toggle down bg-none index-search-btn text-warning border-warning" data-toggle="dropdown">不限</button>
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
        <input type="text" class="form-control bg-none index-q border-warning" name="q" id="q" placeholder="搜目的地/攻略/游记">
        <button type="submit" class="input-group-addon bg-none border-warning"><i class="fa fa-search text-warning fa-lg"></i></button>
    </div>
</form>

<div class="container-fluid py-4">
    <ul class="nav nav-justified nav-search text-nowrap flex-nowrap">
        <li class="nav-item dropdown">
            <a class="nav-link active dropdown-toggle" data-toggle="dropdown" href="#">线路活动</a>
            <div class="dropdown-menu">
                <a class="dropdown-item" data-toggle="tab" href="#nav_1">纵横西部</a>
                <a class="dropdown-item" data-toggle="tab" href="#nav_2">微上西部</a>
                <a class="dropdown-item" data-toggle="tab" href="#nav_3">超级周末</a>
                <a class="dropdown-item" data-toggle="tab" href="#nav_4">最6旅行</a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">线路攻略</a>
            <div class="dropdown-menu">
                <a class="dropdown-item" data-toggle="tab" href="#raider_default">玩法攻略</a>
                <a class="dropdown-item" data-toggle="tab" href="#raider_line">线路攻略</a>
                <a class="dropdown-item" data-toggle="tab" href="#raider_food">美食攻略</a>
                <a class="dropdown-item" data-toggle="tab" href="#raider_scenic">景点攻略</a>
                <a class="dropdown-item" data-toggle="tab" href="#raider_hospital">住宿攻略</a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">旅途短拍</a>
            <div class="dropdown-menu">
                <a class="dropdown-item" data-toggle="tab" href="#film">旅途短拍</a>
                <a class="dropdown-item" data-toggle="tab" href="#live">大咖直播</a>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#travel">精彩游记</a>
        </li>
    </ul>
</div>

<div class="tab-content">
    <div class="a-list tab-pane fade show active" id="nav_1">
        <a href="#" class="card rounded-0 border-0">
            <img class="card-img-top" src="holder.js/100px150" alt="Card image cap">
            <div class="card-body">
                <h6 class="text-truncate">成都 · 大熊猫6天5晚自由行大熊猫6天5晚自由行</h6>
                <p class="card-text text-truncate small">曼谷是一座五光十色的城,以其独有的魅力吸引着来...</p>
            </div>
            <small class="position-absolute text-warning">
                ¥<span class="lead font-weight-bold">7867</span> 起
            </small>
            <p class="position-absolute mb-0">
                <span class="badge badge-pill badge-primary mr-1">自由行</span>
                <span class="badge badge-pill badge-success mr-1">大优惠</span>
                <span class="badge badge-pill badge-danger mr-1">接送机</span>
            </p>
        </a>
    </div>
    <div class="a-list tab-pane fade" id="nav_2">
        <a href="#" class="card rounded-0 border-0">
            <img class="card-img-top" src="holder.js/100px150" alt="Card image cap">
            <div class="card-body">
                <h6 class="text-truncate">成都 · 大熊猫6天5晚自由行大熊猫6天5晚自由行</h6>
                <p class="card-text text-truncate small">曼谷是一座五光十色的城,以其独有的魅力吸引着来...</p>
            </div>
            <small class="position-absolute text-warning">
                ¥<span class="lead font-weight-bold">7867</span> 起
            </small>
            <p class="position-absolute mb-0">
                <span class="badge badge-pill badge-primary mr-1">自由行</span>
                <span class="badge badge-pill badge-success mr-1">大优惠</span>
                <span class="badge badge-pill badge-danger mr-1">接送机</span>
            </p>
        </a>
    </div>
    <div class="a-list tab-pane fade" id="nav_3">
        <a href="#" class="card rounded-0 border-0">
            <img class="card-img-top" src="holder.js/100px150" alt="Card image cap">
            <div class="card-body">
                <h6 class="text-truncate">成都 · 大熊猫6天5晚自由行大熊猫6天5晚自由行</h6>
                <p class="card-text text-truncate small">曼谷是一座五光十色的城,以其独有的魅力吸引着来...</p>
            </div>
            <small class="position-absolute text-warning">
                ¥<span class="lead font-weight-bold">7867</span> 起
            </small>
            <p class="position-absolute mb-0">
                <span class="badge badge-pill badge-primary mr-1">自由行</span>
                <span class="badge badge-pill badge-success mr-1">大优惠</span>
                <span class="badge badge-pill badge-danger mr-1">接送机</span>
            </p>
        </a>
    </div>
    <div class="a-list tab-pane fade" id="nav_4">
        <a href="#" class="card rounded-0 border-0">
            <img class="card-img-top" src="holder.js/100px150" alt="Card image cap">
            <div class="card-body">
                <h6 class="text-truncate">成都 · 大熊猫6天5晚自由行大熊猫6天5晚自由行</h6>
                <p class="card-text text-truncate small">曼谷是一座五光十色的城,以其独有的魅力吸引着来...</p>
            </div>
            <small class="position-absolute text-warning">
                ¥<span class="lead font-weight-bold">7867</span> 起
            </small>
            <p class="position-absolute mb-0">
                <span class="badge badge-pill badge-primary mr-1">自由行</span>
                <span class="badge badge-pill badge-success mr-1">大优惠</span>
                <span class="badge badge-pill badge-danger mr-1">接送机</span>
            </p>
        </a>
    </div>

    <div class="a-list tab-pane fade" id="raider_default">
        <a href="#" class="card rounded-0 border-0">
            <img class="card-img-top" src="holder.js/100px150" alt="Card image cap">
            <div class="card-body">
                <h6 class="text-truncate">成都 · 大熊猫6天5晚自由行大熊猫6天5晚自由行</h6>
                <p class="mb-1 text-truncate small">曼谷是一座五光十色的城,以其独有的魅力吸引着来...</p>
                <p class="mb-0 d-flex justify-content-between small text-secondary text-truncate">
                    <span><i class="fa fa-map-marker-alt"></i> 成都</span>
                    <span><i class="fa fa-eye"></i> 12312</span>
                    <span><i class="fa fa-thumbs-up"></i> 12312</span>
                    <span><i class="fa fa-user"></i> 橙子</span>
                    <span><i class="far fa-clock"></i> 2017-12-12</span>
                </p>
            </div>
        </a>
    </div>
    <div class="a-list tab-pane fade" id="raider_line">
        <a href="#" class="card rounded-0 border-0">
            <img class="card-img-top" src="holder.js/100px150" alt="Card image cap">
            <div class="card-body">
                <h6 class="text-truncate">成都 · 大熊猫6天5晚自由行大熊猫6天5晚自由行</h6>
                <p class="mb-1 text-truncate small">曼谷是一座五光十色的城,以其独有的魅力吸引着来...</p>
                <p class="mb-0 d-flex justify-content-between small text-secondary text-truncate">
                    <span><i class="fa fa-map-marker-alt"></i> 成都</span>
                    <span><i class="fa fa-eye"></i> 12312</span>
                    <span><i class="fa fa-thumbs-up"></i> 12312</span>
                    <span><i class="fa fa-user"></i> 橙子</span>
                    <span><i class="far fa-clock"></i> 2017-12-12</span>
                </p>
            </div>
        </a>
    </div>
    <div class="a-list tab-pane fade" id="raider_food">
        <a href="#" class="card rounded-0 border-0">
            <img class="card-img-top" src="holder.js/100px150" alt="Card image cap">
            <div class="card-body">
                <h6 class="text-truncate">成都 · 大熊猫6天5晚自由行大熊猫6天5晚自由行</h6>
                <p class="mb-1 text-truncate small">曼谷是一座五光十色的城,以其独有的魅力吸引着来...</p>
                <p class="mb-0 d-flex justify-content-between small text-secondary text-truncate">
                    <span><i class="fa fa-map-marker-alt"></i> 成都</span>
                    <span><i class="fa fa-eye"></i> 12312</span>
                    <span><i class="fa fa-thumbs-up"></i> 12312</span>
                    <span><i class="fa fa-user"></i> 橙子</span>
                    <span><i class="far fa-clock"></i> 2017-12-12</span>
                </p>
            </div>
        </a>
    </div>
    <div class="a-list tab-pane fade" id="raider_scenic">
        <a href="#" class="card rounded-0 border-0">
            <img class="card-img-top" src="holder.js/100px150" alt="Card image cap">
            <div class="card-body">
                <h6 class="text-truncate">成都 · 大熊猫6天5晚自由行大熊猫6天5晚自由行</h6>
                <p class="mb-1 text-truncate small">曼谷是一座五光十色的城,以其独有的魅力吸引着来...</p>
                <p class="mb-0 d-flex justify-content-between small text-secondary text-truncate">
                    <span><i class="fa fa-map-marker-alt"></i> 成都</span>
                    <span><i class="fa fa-eye"></i> 12312</span>
                    <span><i class="fa fa-thumbs-up"></i> 12312</span>
                    <span><i class="fa fa-user"></i> 橙子</span>
                    <span><i class="far fa-clock"></i> 2017-12-12</span>
                </p>
            </div>
        </a>
    </div>
    <div class="a-list tab-pane fade" id="raider_hospital">
        <a href="#" class="card rounded-0 border-0">
            <img class="card-img-top" src="holder.js/100px150" alt="Card image cap">
            <div class="card-body">
                <h6 class="text-truncate">成都 · 大熊猫6天5晚自由行大熊猫6天5晚自由行</h6>
                <p class="mb-1 text-truncate small">曼谷是一座五光十色的城,以其独有的魅力吸引着来...</p>
                <p class="mb-0 d-flex justify-content-between small text-secondary text-truncate">
                    <span><i class="fa fa-map-marker-alt"></i> 成都</span>
                    <span><i class="fa fa-eye"></i> 12312</span>
                    <span><i class="fa fa-thumbs-up"></i> 12312</span>
                    <span><i class="fa fa-user"></i> 橙子</span>
                    <span><i class="far fa-clock"></i> 2017-12-12</span>
                </p>
            </div>
        </a>
    </div>

    <div class="a-list tab-pane fade" id="travel">
        <a href="#" class="card rounded-0 border-0">
            <img class="card-img-top" src="holder.js/100px150" alt="Card image cap">
            <div class="card-body">
                <h6 class="text-truncate">玩法 · 大熊猫6天5晚自由行大熊猫6天5晚自由行</h6>
                <p class="mb-1 text-truncate small">曼谷是一座五光十色的城,以其独有的魅力吸引着来...</p>
                <p class="mb-0 d-flex justify-content-between small text-secondary text-truncate">
                    <span><i class="fa fa-map-marker-alt"></i> 成都</span>
                    <span><i class="fa fa-eye"></i> 12312</span>
                    <span><i class="fa fa-thumbs-up"></i> 12312</span>
                    <span><i class="fa fa-user"></i> 橙子</span>
                    <span><i class="far fa-clock"></i> 2017-12-12</span>
                </p>
            </div>
        </a>
    </div>

    <div class="a-list tab-pane fade" id="film">
        <a href="#" class="card rounded-0 border-0">
            <img class="card-img-top" src="holder.js/100px150" alt="Card image cap">
            <div class="card-body">
                <h6 class="text-truncate">成都 · 大熊猫6天5晚自由行大熊猫6天5晚自由行</h6>
                <p class="card-text text-truncate small">曼谷是一座五光十色的城,以其独有的魅力吸引着来...</p>
            </div>
            <p class="position-absolute mb-0">
                <i class="fa fa-play-circle fa-lg"></i>
            </p>
        </a>
    </div>
    <div class="a-list tab-pane fade" id="live">
        <a href="#" class="card rounded-0 border-0">
            <img class="card-img-top" src="holder.js/100px150" alt="Card image cap">
            <div class="card-body">
                <h6 class="text-truncate">成都 · 大熊猫6天5晚自由行大熊猫6天5晚自由行</h6>
                <p class="card-text text-truncate small">曼谷是一座五光十色的城,以其独有的魅力吸引着来...</p>
            </div>
            <p class="position-absolute mb-0">
                <i class="fa fa-play-circle fa-lg"></i>
            </p>
        </a>
    </div>
</div>

<p class="text-center text-secondary small">
    <i class="fas fa-sync fa-spin"></i> 更多精彩加载中...
</p>
@endsection