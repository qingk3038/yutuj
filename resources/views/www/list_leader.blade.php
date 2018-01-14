@extends('layouts.app')

@section('title',  ($province->name ?? '') . '大咖领路')

@section('content')
    <div class="bg-home text-hide" style="background-image: url({{ asset('img/bg_leader.jpg') }});">领队</div>

    <div class="container">
        <div class="py-4"><a href="{{ url('/') }}">首页</a> &gt; <span class="text-warning">大咖领路</span></div>
    </div>

    <div class="container" id="load">
        <div class="bg-white mb-4 py-3 list-param">
            <div class="row px-3">
                <div class="col-1 text-center text-nowrap">区域</div>
                <div class="col-10 text-truncate">
                    <a href="{{ route('www.leader.list') }}" @empty($province) class="active" @endempty>全部</a>
                    @foreach($provinces as $qu)
                        <a href="{{ route('www.leader.list', $qu) }}" @if($province && $province->id === $qu->id) class="active" @endif>{{ $qu->name }}</a>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="row list-leader">
            @foreach($leaders as $leader)
                <div class="col-6">
                    <a href="{{ route('www.leader.show', $leader) }}" class="d-block bg-white px-3 py-5 mb-4" target="_blank">
                        <div class="media">
                            <img class="mr-5 rounded-circle" src="{{ imageCut(180, 180, $leader->avatar) }}" alt="{{ $leader->name }}" width="180" height="180">
                            <div class="media-body">
                                <h4 class="text-warning">{{ $leader->name }}</h4>
                                <p class="text-warning text-justify">
                                    <i class="fa fa-fw fa-map-marker"></i>{{ $leader->country->name }}
                                    <span class="ml-2">{{ $leader->province->name }}</span>
                                    @if($leader->city)
                                        <span class="ml-2">{{ $leader->city->name }}</span>
                                    @endif
                                </p>
                                <div class="small text-muted">{{ $leader->brief }}</div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <div class="container">
        <div class="bg-white p-5">
            <h3 class="text-warning mb-4"><i class="fa fa-fw fa-flag-o"></i> 猜你喜欢</h3>
            <div class="row">
                @foreach($activities as $activity)
                    <div class="col-3">
                        <div class="card">
                            <a href="{{ route('www.activity.show', $activity) }}"><img class="card-img-top" src="{{ imageCut(255, 170, $activity->thumb) }}" alt="{{ $activity->short }}"></a>
                            <div class="card-body">
                                <p>
                                    <a href="{{ route('www.activity.show', $activity) }}" class="card-title">
                                        <span class="text-danger font-weight-bold">{{ $activity->types->first()->text }}</span>
                                        {{ str_limit($activity->title, 36) }}
                                    </a>
                                </p>
                                <p class="card-text">
                                    <span class="text-danger font-weight-bold lead">¥{{ $activity->price }}</span>
                                    <small>起</small>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        (function () {
            $('#load').on('click', '.list-param a', function (event) {
                event.preventDefault()
                let url = $(this).attr('href') + ' #load > div'
                $('#load').load(url, function () {
                    $('body,html').animate({scrollTop: $(this).offset().top}, 500)
                })
            })
        })(jQuery)
    </script>
@endpush
