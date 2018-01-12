@extends('layouts.m')

@section('title', '我的设置')

@section('header')
    @include('m.header', ['title' => '我的设置'])
@endsection

@section('content')
    <div class="pt-5 home-setting">
        <div class="list-group my-3">
            <a href="{{ route('home.setting', 'avatar') }}" class="list-group-item d-flex justify-content-between align-items-center list-group-item-action">
                头像
                <span>
                    <img class="rounded-circle" src="{{ auth()->user()->avatar }}" alt="头像" width="30" height="30">
                    <i class="fa fa-angle-right ml-auto"></i>
                </span>
            </a>
            <a href="{{ route('home.setting', 'name') }}" class="list-group-item d-flex justify-content-between align-items-center list-group-item-action">
                昵称
                <span>
                {{ auth()->user()->name }}
                <i class="fa fa-angle-right ml-auto"></i>
            </span>
            </a>
            <a href="{{ route('home.setting', 'sex') }}" class="list-group-item d-flex justify-content-between align-items-center list-group-item-action">
                性别
                <span>
                {{ auth()->user()->sex === 'F' ? '女' : '男' }}
                <i class="fa fa-angle-right ml-auto"></i>
            </span>
            </a>
            <a href="{{ route('home.setting', 'city') }}" class="list-group-item d-flex justify-content-between align-items-center list-group-item-action">
                居住城市
                <span>
                {{ auth()->user()->province }} {{ auth()->user()->city }}
                    <i class="fa fa-angle-right ml-auto"></i>
                </span>
            </a>
            <a href="{{ route('home.setting', 'birthday') }}" class="list-group-item d-flex justify-content-between align-items-center list-group-item-action">
                出生日期
                <span>
                   {{ auth()->user()->birthday }}
                    <i class="fa fa-angle-right ml-auto"></i>
                </span>
            </a>
            <a href="{{ route('home.setting', 'description') }}" class="list-group-item d-flex justify-content-between align-items-center list-group-item-action">
                个人简介
                <i class="fa fa-angle-right ml-auto"></i>
            </a>
        </div>

        <div class="list-group mb-5">
            <a href="{{ route('home.setting', 'mobile') }}" class="list-group-item d-flex justify-content-between align-items-center list-group-item-action">
                修改绑定手机号
                <span>
                    {{ preg_replace('/(\d{3})\d\d(\d{2})/', '$1****$3', auth()->user()->mobile) }}
                    <i class="fa fa-angle-right ml-auto"></i>
            </span>
            </a>
            <a href="{{ route('home.setting', 'password') }}" class="list-group-item d-flex justify-content-between align-items-center list-group-item-action">
                修改密码
                <i class="fa fa-angle-right ml-auto"></i>
            </a>
        </div>

        <a href="{{ route('logout') }}" class="btn btn-block btn-light text-warning rounded-0 fixed-bottom" style="padding: 0.7rem;">
            退出当前账号
        </a>
    </div>

@endsection

@section('footer', false)
