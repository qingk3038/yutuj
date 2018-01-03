@extends('layouts.app')

@section('title', $raider->title)

@section('content')
    <div class="container">
        <div class="py-4">
            <a href="{{ url('/') }}">首页</a> &gt;
            <a href="{{ route('www.raider.list') }}">攻略</a> &gt;
            <span class="text-warning">{{ $raider->typeText() }}攻略</span>
        </div>
    </div>

    <div class="container mb-4">
        <div class="bg-white p-4">
            <h4>{{ $raider->typeText() }} · {{ $raider->title }}</h4>
            <div class="text-muted pt-2">
                <span>发布时间：{{ $raider->created_at }}</span>
                <span class="mx-3">浏览量：{{ $raider->click }}</span>
                <span>上传：{{ $raider->admin->name }}</span>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-8">
                <div class="bg-white p-4 h-100">{{ $raider->body }}</div>
            </div>
            <div class="col-4 pl-0">
                @include('www.right', ['province_rel' => $raider->province])
            </div>
        </div>
    </div>
@endsection