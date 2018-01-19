@extends('layouts.m')

@section('title', $article->title)

@section('header')
    @include('m.header', ['title' => $article->title, 'theme' => 'white'])
@endsection

@section('content')
    <div class="p-4 mt-5">
        <div class="small text-justify font-weight-light div-body">
            {!! $article->body !!}
        </div>
    </div>
@endsection
