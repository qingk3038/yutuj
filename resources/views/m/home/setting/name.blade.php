@extends('layouts.m')

@section('title', '我的设置')

@section('header', false)

@section('content')
    <header class="position-absolute bg-white container-fluid">
        <div class="text-warning row">
            <span class="col-3" onclick="history.back();"><i class="fas fa-lg fa-angle-left"></i></span>
            <span class="col text-center">个人昵称</span>
            <span class="col-3 text-right do-complete">完成</span>
        </div>
    </header>
    <form class="mt-5 p-4" id="info" action="{{ route('user.update') }}">
        <input type="text" class="form-control" placeholder="个人昵称" name="name" value="{{ auth()->user()->name }}">
    </form>
@endsection

@section('footer', false)