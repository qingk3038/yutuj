@extends('layouts.m')

@section('title', '领队' . $leader->name . '的主页')

@section('header')
    <header class="position-absolute">
        <div class="text-white d-flex justify-content-between">
            <span onclick="history.back();"><i class="fas fa-lg fa-angle-left"></i></span>
            <span>领队详情</span>
            <a href="auth/login.html">
                <i class="fa fa-fw fa-user"></i>
                <!--<img class="rounded-circle" src="img/avatar.png" alt="avatar" width="22" height="22">-->
            </a>
        </div>
    </header>

    <div class="position-relative show-leader">
        <div class="bg-leader text-hide position-absolute" style="background-image: url({{ imageCut(414, 220, $leader->bg_home) }});"></div>
        <div class="text-center">
            <div class="avatar position-relative">
                <img class="rounded-circle" src="{{ imageCut(120, 120, $leader->avatar) }}" alt="{{ $leader->name }}" height="120" width="120">
                <span class="fa-stack position-absolute">
                    @if($leader->sex === 'F')
                        <i class="fa fa-circle fa-stack-2x text-danger"></i>
                        <i class="fa fa-venus fa-stack-1x fa-inverse"></i>
                    @else
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-mars fa-stack-1x fa-inverse"></i>
                    @endif
            </span>
            </div>
            <div class="text-white px-3 small font-weight-light">{{ $leader->brief }}</div>
        </div>
    </div>
    <div class="top-border pt-3">
        <div class="media bg-light p-3">
            <img class="mr-3" src="{{ imageCut(100, 150, $leader->avatar) }}" alt="{{ $leader->name }}" width="100" height="150">
            <div class="media-body">
                <h5 class="text-warning left-border-orange ml-0">{{ $leader->name }}</h5>
                <p class="small mb-1 text-warning text-justify">
                    <i class="fa fa-map-marker-alt"></i>
                    <span class="mr-1">{{ $leader->country->name }}</span>
                    <span class="mr-1">{{ $leader->province->name }}</span>
                    <span class="mr-1">{{ $leader->city->name ?? ''}}</span>
                    <span class="mr-1">{{ $leader->district->name ?? '' }}</span>
                </p>
                <div class="small font-weight-light">{!! nl2br($leader->description) !!}</div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <p class="text-warning text-center mt-3">关于TA</p>
        <hr>
        <p class="mb-1"><i class="fa fa-quote-left fa-lg text-secondary"></i></p>
        <div class="small font-weight-light">{!! nl2br($leader->introduction) !!}</div>
        <p class="text-right"><i class="fa fa-quote-right fa-lg text-secondary"></i></p>
    </div>

    <div class="py-3" style="border-top: 10px solid #f7f7f7; border-bottom: 10px solid #f7f7f7;">
        <div class="roll-x">
            <div class="d-flex flex-nowrap">
                @foreach($leader->photos as $photo)
                    <img class="m-1" src="{{ imageCut(165, 140, $photo) }}" alt="展示图{{ $loop->iteration }}">
                @endforeach
            </div>
        </div>
    </div>

    <div class="p-3 text-warning text-center">TA领队的活动</div>
    <div class="a-list">
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
        <p class="text-center text-secondary small">
            <i class="fas fa-sync fa-spin"></i> 更多精彩加载中...
        </p>
    </div>
@endsection

@push('script')
    <link href="{{ asset('css/jquery.mCustomScrollbar.min.css') }}" rel="stylesheet">
    <script src="{{ asset('js/jquery.mCustomScrollbar.min.js') }}"></script>
    <script>
        (function ($) {
            $('.roll-x').mCustomScrollbar({
                axis: 'x',
                theme: 'rounded-dark',
                scrollbarPosition: 'outside'
            })
        })(jQuery);
    </script>
@endpush