@extends('layouts.m')

@section('title', '游记列表')

@section('header')
    @include('m.header', ['title' => '游记'])
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
                <img class="d-block w-100" src="holder.js/100px310?random=yes" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="holder.js/100px310?random=yes" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="holder.js/100px310?random=yes" alt="Third slide">
            </div>
        </div>
    </div>

    <div class="container-fluid top-border">
        <div class="py-3 d-flex">
            <a class="text-dark pr-4" data-toggle="collapse" href="#dq">
                地区/目的地<i class="fa fa-fw fa-caret-down"></i>
            </a>
            <a class="text-dark pr-4" data-toggle="collapse" href="#sort">
                综合排序<i class="fa fa-fw fa-caret-down"></i>
            </a>
        </div>
    </div>

    <form class="container-fluid" id="screen" data-children=".item">
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
                            <input type="radio" name="province" value="{{ $province->title }}"> {{ $province->title }}
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
                            <input type="radio" name="city" value="{{ $city->title }}"> {{ $city->title }}
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
                        <input type="radio" name="field" value="click"> 热门度
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

    <div class="a-list infiniteScroll">
        @foreach($travels as $travel)
            <a href="{{ route('m.travel.show', $travel) }}" class="card border-0 item">
                <img class="card-img-top rounded-0" src="{{ imageCut(414, 150, $travel->thumb)  }}" alt="{{ $travel->title }}" width="414" height="150">
                <div class="card-body">
                    <h6 class="text-truncate w-100">{{ $travel->title }}</h6>
                    <p class="mb-2 text-truncate small">{{ $travel->description }}</p>
                    <p class="mb-0 d-flex small text-secondary text-truncate">
                        @if($travel->province)
                            <span class="mr-2"><i class="fa fa-map-marker-alt"></i> {{ $travel->province }} {{ $travel->city }}</span>
                        @endif
                        <span class="mr-2"><i class="fa fa-eye"></i> {{ $travel->click }}</span>
                        <span class="mr-2"><i class="fa fa-thumbs-up"></i> {{ $travel->likes_count }}</span>
                        <span class="mr-2"><i class="fa fa-user"></i> {{ $travel->user->name ?? $travel->user->getHideMobile() }}</span>
                        <span class="ml-auto"><i class="far fa-clock"></i> {{ $travel->created_at->toDateString() }}</span>
                    </p>
                </div>
            </a>
        @endforeach
        <nav class="d-flex justify-content-center">
            {{ $travels->appends(Request::all())->links('vendor.pagination.m') }}
        </nav>
    </div>
    <div class="text-center text-secondary small page-load-status" style="display: none;">
        <p class="infinite-scroll-request"><i class="fas fa-sync fa-spin"></i> 更多精彩加载中...</p>
        <p class="infinite-scroll-last">已全部加载</p>
        <p class="infinite-scroll-error">已全部加载</p>
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