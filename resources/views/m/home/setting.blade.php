@extends('layouts.m')

@section('title', '我的设置')

@section('header')
    <header class="position-absolute bg-white">
        <div class="text-warning d-flex justify-content-between">
            <span onclick="history.back();"><i class="fas fa-lg fa-angle-left"></i></span>
            <span>我的设置</span>
            <div>
                <a href="{{ route('home') }}">
                    <img class="rounded-circle" src="{{ auth()->user()->avatar }}" alt="avatar" width="22" height="22">
                </a>
                <a href="#menu" class="text-warning" data-toggle="collapse">
                    <i class="fa fa-fw fa-align-justify"></i>
                </a>
            </div>
        </div>
    </header>
    @include('m.header')
@endsection

@section('content')
    <div class="pt-5 home-setting">
        <div class="list-group my-3">
            <a href="setting_edit.blade.php" class="list-group-item d-flex justify-content-between align-items-center list-group-item-action">
                头像
                <span>
                <img class="rounded-circle" src="holder.js/22x22" alt="头像" width="60" height="60">
                <i class="fa fa-angle-right ml-auto"></i>
            </span>
            </a>
            <a href="setting_edit.blade.php" class="list-group-item d-flex justify-content-between align-items-center list-group-item-action">
                昵称
                <span>
                土豆豆
                <i class="fa fa-angle-right ml-auto"></i>
            </span>
            </a>
            <a href="setting_edit.blade.php" class="list-group-item d-flex justify-content-between align-items-center list-group-item-action">
                性别
                <span>
                男
                <i class="fa fa-angle-right ml-auto"></i>
            </span>
            </a>
            <a href="setting_edit.blade.php" class="list-group-item d-flex justify-content-between align-items-center list-group-item-action">
                居住城市
                <span>
                成都
                <i class="fa fa-angle-right ml-auto"></i>
            </span>
            </a>
            <a href="setting_edit.blade.php" class="list-group-item d-flex justify-content-between align-items-center list-group-item-action">
                出生日期
                <span>
                1990.08.19
                <i class="fa fa-angle-right ml-auto"></i>
            </span>
            </a>
            <a href="setting_edit.blade.php" class="list-group-item d-flex justify-content-between align-items-center list-group-item-action">
                个人简介
                <i class="fa fa-angle-right ml-auto"></i>
            </a>
        </div>

        <div class="list-group mb-5">
            <a href="setting_edit.blade.php" class="list-group-item d-flex justify-content-between align-items-center list-group-item-action">
                修改绑定手机号
                <span>
                156****1868
                <i class="fa fa-angle-right ml-auto"></i>
            </span>
            </a>
            <a href="setting_edit.blade.php" class="list-group-item d-flex justify-content-between align-items-center list-group-item-action">
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
