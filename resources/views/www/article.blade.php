@extends('layouts.app')

@section('title', $article->title)

@section('content')
    <div class="container">
        <div class="py-4"><a href="{{ url('/') }}">首页</a> &gt; <span class="text-warning">{{ $article->title }}</span></div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-8">
                <div class="bg-white p-4">
                    <h5>{{ $article->title }}</h5>
                    <br>
                    {{ $article->body }}
                </div>
            </div>
            <div class="col-4 pl-0">
                <div class="bg-white p-3 text-center">
                    <a href="{{ route('www.raider.list') }}" class="d-block mb-3"><img class="img-fluid" src="{{ asset('img/page_r_raiders.jpg') }}" alt="raider"></a>
                    <a href="{{ route('www.travel.list') }}" class="d-block mb-3"><img class="img-fluid" src="{{ asset('img/page_r_travels.jpg') }}" alt="travel"></a>
                    <a href="{{ route('www.video.list') }}" class="d-block"><img class="img-fluid" src="{{ asset('img/page_r_video.jpg') }}" alt="video"></a>
                </div>
            </div>
        </div>
    </div>
@endsection