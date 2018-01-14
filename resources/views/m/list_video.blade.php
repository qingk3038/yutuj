@extends('layouts.m')

@section('title', '旅拍直播')

@section('header')
    @include('m.header', ['title' => '旅拍直播', 'theme' => 'white'])
@endsection

@section('content')
    <img class="d-block w-100" src="holder.js/100px220" alt="100px220">

    <ul class="nav justify-content-center top-border nav-two">
        <li class="nav-item">
            <a class="nav-link @if(request('type', 'film') === 'film') active @endif" href="{{ route('m.video.list', ['type' => 'film']) }}">旅途短拍</a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if(request('type') === 'live') active @endif" href="{{ route('m.video.list', ['type' => 'live']) }}">大咖直播</a>
        </li>
    </ul>

    <div class="container-fluid top-border">
        <div class="py-3 d-flex">
            <a class="text-dark pr-4" data-toggle="collapse" href="#dq">
                地区<i class="fa fa-fw fa-caret-down"></i>
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
                    <span>地区</span>
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
                    <span>排序</span>
                    <span><i class="fa fa-fw fa-angle-down"></i></span>
                </div>
                <div class="btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-light">
                        <input type="radio" name="field" value=""> 不限
                    </label>
                    <label class="btn btn-light">
                        <input type="radio" name="field" value="price"> 热门点击
                    </label>
                    <label class="btn btn-light">
                        <input type="radio" name="field" value="created_at"> 最新上传
                    </label>
                    <label class="btn btn-light">
                        <input type="radio" name="field" value="updated_at"> 最近更新
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
            <div class="collapse" data-parent="#screen" id="type">
                <div class="d-flex justify-content-between mb-2">
                    <span>类别</span>
                    <span><i class="fa fa-fw fa-angle-down"></i></span>
                </div>
                <div class="btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-light">
                        <input type="radio" name="type" value="" @unless(request('type')) checked @endunless> 全部
                    </label>
                    <label class="btn btn-light">
                        <input type="radio" name="type" value="film" @if(request('type') === 'film') checked @endif> 旅途短拍
                    </label>
                    <label class="btn btn-light">
                        <input type="radio" name="type" value="live" @if(request('type') === 'live') checked @endif> 大咖直播
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
        @foreach($videos as $video)
            <a href="{{ route('m.video.show', $video) }}" class="card border-0" @if($video->type === 'live') target="_blank" @endif>
                <img class="card-img-top rounded-0" src="{{ imageCut(414, 150, $video->thumb) }}" alt="{{ $video->title }}" width="414" height="150">
                <div class="card-body">
                    <h6 class="text-truncate w-100">{{ $video->province->name }} · {{ $video->title }}</h6>
                    <p class="card-text text-truncate small">{{ $video->description }}</p>
                </div>
                <p class="position-absolute mb-0">
                    <i class="fa fa-play-circle fa-lg"></i>
                </p>
            </a>
        @endforeach
        <nav class="d-flex justify-content-center">
            {{ $videos->links('vendor.pagination.m') }}
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