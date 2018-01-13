@extends('layouts.m')

@section('title', '活动列表')

@section('header')
    @include('m.header', ['title' => '活动'])
    @include('m.provinces')
@endsection

@section('content')
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
                    <span>排序内容</span>
                    <span><i class="fa fa-fw fa-angle-down"></i></span>
                </div>
                <div class="btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-light">
                        <input type="radio" name="field" value=""> 不限
                    </label>
                    <label class="btn btn-light">
                        <input type="radio" name="field" value="price"> 价格
                    </label>
                    <label class="btn btn-light">
                        <input type="radio" name="field" value="created_at"> 发布时间
                    </label>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span>排序类型</span>
                    <span><i class="fa fa-fw fa-angle-down"></i></span>
                </div>
                <div class="btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-light">
                        <input type="radio" name="order" value=""> 不限
                    </label>
                    <label class="btn btn-light">
                        <input type="radio" name="order" value="asc"> 升序
                    </label>
                    <label class="btn btn-light">
                        <input type="radio" name="order" value="desc"> 降序
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
                <img class="card-img-top" src="{{ imageCut(414, 150, $activity->thumb) }}" alt="{{ $activity->title }}" width="414" height="150">
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
    </div>
@endsection

@push('script')
    <script>
        (function ($) {
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
        })(jQuery);
    </script>
@endpush