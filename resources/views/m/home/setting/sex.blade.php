@extends('layouts.m')

@section('title', '我的设置')

@section('header', false)

@section('content')
    <header class="position-absolute bg-white container-fluid">
        <div class="text-warning row">
            <span class="col-3" onclick="history.back();"><i class="fas fa-lg fa-angle-left"></i></span>
            <span class="col text-center">性别</span>
            <span class="col-3 text-right do-complete">完成</span>
        </div>
    </header>
    <form class="mt-5 px-3" id="info" action="{{ route('user.update') }}">
        <label class="d-flex justify-content-between m-0 py-3">
            男
            <input type="radio" name="sex" value="M" @if(auth()->user()->sex === 'M') checked @endif>
        </label>
        <hr class="m-0">
        <label class="d-flex justify-content-between mb-0 py-3">
            女
            <input type="radio" name="sex" value="F" @if(auth()->user()->sex === 'F') checked @endif>
        </label>
    </form>
@endsection

@section('footer', false)