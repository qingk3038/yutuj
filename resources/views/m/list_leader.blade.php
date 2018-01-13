@extends('layouts.m')

@section('title',  ($province->name ?? '') . '大咖领路')

@section('header')
    @include('m.header', ['title' => '大咖领路'])
@endsection

@section('content')
    <img class="d-block w-100" src="{{ asset('m/img/banner_leader.jpg') }}" alt="领队列表">

    <div class="container-fluid top-border">
        <div class="py-3 d-flex">
            <a class="text-dark pr-4" data-toggle="collapse" href="#dq">
                区域<i class="fa fa-fw fa-caret-down"></i>
            </a>
        </div>
    </div>
    <div id="load">
        <div class="container-fluid" id="screen" data-children=".item">
            <div class="item">
                <div class="collapse" data-parent="#screen" id="dq">
                    <a href="{{ route('m.leader.list') }}" class="btn btn-light mb-2 @empty($province) active @endempty">全部</a>
                    @foreach($provinces as $qu)
                        <a href="{{ route('m.leader.list', $qu) }}" class="btn btn-light mb-2 @if($province && $province->id === $qu->id) active @endif">{{ $qu->name }}</a>
                    @endforeach
                </div>
            </div>
        </div>
        <div>
            @foreach($leaders as $leader)
                <a href="{{ route('m.leader.show', $leader) }}" class="media bg-light p-3 mb-3">
                    <img class="mr-4 rounded-circle" src="{{ imageCut(100, 100, $leader->avatar) }}" alt="{{ $leader->name }}" width="100" height="100">
                    <div class="media-body">
                        <h5 class="left-border-orange text-warning">{{ $leader->name }}</h5>
                        <p class="text-warning mb-2"><i class="fa fa-map-marker-alt"></i> {{ $leader->province->name }} {{ $leader->city->name ?? '' }}</p>
                        <small class="text-secondary text-justify">{{ $leader->brief }}</small>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection

@push('script')
    <script>
        (function () {
            $('#load').on('click', '#dq > a', function (event) {
                event.preventDefault()
                let url = $(this).attr('href') + ' #load > div'
                $('#load').load(url, function () {
                   $('#screen .collapse').addClass('show')
                })
            })
        })(jQuery)
    </script>
@endpush
