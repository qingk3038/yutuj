@extends('layouts.m')

@section('title', '我的设置')

@section('header', false)

@section('content')
    <header class="position-absolute bg-white container-fluid">
        <div class="text-warning row">
            <span class="col-3" onclick="history.back();"><i class="fas fa-lg fa-angle-left"></i></span>
            <span class="col text-center">个人简介</span>
            <span class="col-3 text-right do-complete">完成</span>
        </div>
    </header>
    <form class="mt-5 p-4" id="info" action="{{ route('user.update') }}">
        <textarea class="form-control" rows="5" placeholder="一段话介绍你自己，50字以内" name="description">{{ auth()->user()->description }}</textarea>
    </form>
@endsection

@section('footer', false)
