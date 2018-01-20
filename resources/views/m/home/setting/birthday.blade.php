@extends('layouts.m')

@section('title', '我的设置')

@section('header', false)

@section('content')
    <header class="position-absolute bg-white container-fluid">
        <div class="text-warning row">
            <span class="col-3" onclick="history.back();"><i class="fas fa-lg fa-angle-left"></i></span>
            <span class="col text-center">出生日期</span>
            <span class="col-3 text-right do-complete">完成</span>
        </div>
    </header>
    <form class="mt-5 p-4" id="info" action="{{ route('user.update') }}">
        <label>出生日期</label>
        <input type="date" class="form-control" placeholder="出生日期" name="birthday" value="{{ auth()->user()->birthday ?: today()->toDateString() }}" max="{{ today()->toDateString() }}" min="{{ now()->subYear(60)->toDateString() }}">
    </form>
@endsection

@section('footer', false)
