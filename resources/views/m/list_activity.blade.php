@extends('layouts.m')

@section('title', '活动')

@section('header')
    <header class="position-absolute">
        <div class="text-white d-flex justify-content-between">
            <span onclick="history.back();"><i class="fas fa-lg fa-angle-left"></i></span>
            <div>
                @auth
                    <a href="{{ route('home') }}"><img class="rounded-circle" src="{{ auth()->user()->avatar }}" alt="avatar" width="22" height="22"></a>
                @else
                    <a href="{{ route('login') }}"> <i class="fa fa-fw fa-user"></i></a>
                @endauth
            </div>
        </div>
    </header>

    @include('m.provinces')

    <div id="banner" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#banner" data-slide-to="0" class="active"></li>
            <li data-target="#banner" data-slide-to="1"></li>
            <li data-target="#banner" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="{{ asset('m/img/banner_list_1.jpg') }}" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="{{ asset('m/img/banner_list_1.jpg') }}" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="{{ asset('m/img/banner_list_1.jpg') }}" alt="Third slide">
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-fluid top-border">
        <div class="py-3 d-flex justify-content-between">
            <a class="text-dark" data-toggle="collapse" href="#dq">
                区域/目的地<i class="fa fa-fw fa-caret-down"></i>
            </a>
            <a class="text-dark" data-toggle="collapse" href="#play">
                游玩天数<i class="fa fa-fw fa-caret-down"></i>
            </a>
            <a class="text-dark" data-toggle="collapse" href="#sort">
                综合排序<i class="fa fa-fw fa-caret-down"></i>
            </a>
        </div>
    </div>

    <form class="container-fluid" id="screen" data-children=".item" autocomplete="off">
        <div class="item">
            <div class="collapse" data-parent="#screen" id="dq">
                <div class="d-flex justify-content-between mb-2">
                    <span>区域</span>
                    <span><i class="fa fa-fw fa-angle-down"></i></span>
                </div>
                <div class="btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-light">
                        <input type="radio" name="pid" value=""> 全部
                    </label>
                    @foreach($provinces as $province)
                        <label class="btn btn-light">
                            <input type="radio" name="pid" value="{{ $province->id }}"> {{ $province->name }}
                        </label>
                    @endforeach
                </div>
                <div class="d-flex justify-content-between  mb-2">
                    <span>目的地</span>
                    <span><i class="fa fa-fw fa-angle-down"></i></span>
                </div>
                <div class="btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-light">
                        <input type="radio" name="cid" value=""> 全部
                    </label>
                    @foreach($cities as $city)
                        <label class="btn btn-light">
                            <input type="radio" name="cid" value="{{ $city->id }}"> {{ $city->name }}
                        </label>
                    @endforeach
                </div>
                <div class="px-3 py-2 mb-2">
                    <div class="row">
                        <div class="col-6 p-0">
                            <span class="btn btn-block rounded-0 btn-outline-secondary btn-reset">重 &nbsp; 置</span>
                        </div>
                        <div class="col-6 p-0">
                            <button type="submit" class="btn btn-block rounded-0 btn-warning">确 &nbsp; 认</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="collapse" data-parent="#screen" id="play">
                <div class="d-flex justify-content-between mb-2">
                    <span>游玩天数</span>
                    <span><i class="fa fa-fw fa-angle-down"></i></span>
                </div>
                <div class="btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-light">
                        <input type="radio" name="day" value=""> 不限
                    </label>
                    @for($i =1; $i<=10; $i++)
                        <label class="btn btn-light">
                            <input type="radio" name="day" value="{{ $i }}"> {{ $i }}日游 @if($i === 11)以上 @endif
                        </label>
                    @endfor
                    <label class="btn btn-light">
                        <input type="radio" name="day" value="11"> 10日游以上
                    </label>
                </div>
                <div class="px-3 py-2 mb-2">
                    <div class="row">
                        <div class="col-6 p-0">
                            <span class="btn btn-block rounded-0 btn-outline-secondary btn-reset">重 &nbsp; 置</span>
                        </div>
                        <div class="col-6 p-0">
                            <button type="submit" class="btn btn-block rounded-0 btn-warning">确 &nbsp; 认</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="collapse" data-parent="#screen" id="sort">
                <div class="d-flex justify-content-between mb-2">
                    <span>价格排序</span>
                    <span><i class="fa fa-fw fa-angle-down"></i></span>
                </div>
                <div class="btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-light">
                        <input type="radio" name="order_price" value=""> 不限
                    </label>
                    <label class="btn btn-light">
                        <input type="radio" name="order_price" value="asc"> 价格升序
                    </label>
                    <label class="btn btn-light">
                        <input type="radio" name="order_price" value="desc"> 价格降序
                    </label>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span>发布时间</span>
                    <span><i class="fa fa-fw fa-angle-down"></i></span>
                </div>
                <div class="btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-light">
                        <input type="radio" name="order_created_at" value=""> 不限
                    </label>
                    <label class="btn btn-light">
                        <input type="radio" name="order_created_at" value="asc"> 升序
                    </label>
                    <label class="btn btn-light">
                        <input type="radio" name="order_created_at" value="desc"> 降序
                    </label>
                </div>
                <div class="px-3 py-2 mb-2">
                    <div class="row">
                        <div class="col-6 p-0">
                            <span class="btn btn-block rounded-0 btn-outline-secondary btn-reset">重 &nbsp; 置</span>
                        </div>
                        <div class="col-6 p-0">
                            <button type="submit" class="btn btn-block rounded-0 btn-warning">确 &nbsp; 认</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="a-list">
        @php
            $tag_btns = ['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark'];
        @endphp
        @foreach($activities as $activity)
            <a href="{{ route('m.activity.show', $activity) }}" class="card rounded-0 border-0">
                <img class="card-img-top" src="{{ imageCut(375, 150, $activity->thumb) }}" alt="{{ $activity->title }}">
                <div class="card-body">
                    <h6 class="text-truncate">{{ $activity->province->name }} · {{ $activity->title }}</h6>
                    <p class="card-text text-truncate small">{{ $activity->description }}</p>
                </div>
                <small class="position-absolute text-warning">
                    ¥<span class="lead font-weight-bold">{{ $activity->price }}</span> 起
                </small>
                <p class="position-absolute mb-0">
                    @foreach($activity->tags as $tag)
                        <span class="badge badge-pill badge-{{ $tag_btns[mt_rand(0, 7)] }} mr-1">{{ $tag->text }}</span>
                    @endforeach
                </p>
            </a>
        @endforeach

        <nav class="d-flex justify-content-center">
            {{ $activities->links('vendor.pagination.m') }}
        </nav>
        {{--
         <p class="text-center text-secondary small">
             <i class="fas fa-sync fa-spin"></i> 更多精彩加载中...
         </p>
         --}}
    </div>
@endsection

@push('script')
    <script>
        let params = @json(Request::all())

            // 默认参数
            initSelect()

        // 重置按钮点击
        $('.btn-reset').click(function () {
            initSelect(this)
        })

        function initSelect(_this) {
            let div = _this === undefined ? $('.item') : $(_this).closest('.item')
            let btn_group = div.find('.btn-group-toggle')

            let label = btn_group.find('label:first')
            label.addClass('active').siblings().removeClass('active')
            label.prop('checked', true)

            $.each(params, function (index, value) {
                let input = div.find('input[name="' + index + '"][value="' + value + '"]')
                input.prop('checked', true)
                input.parent().addClass('active').siblings().removeClass('active')
            })
        }
    </script>
@endpush