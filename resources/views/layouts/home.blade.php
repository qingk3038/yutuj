@extends('layouts.app')

@section('title', (auth()->user()->name ?? auth()->user()->mobile) . '的个人主页')

@section('content')
    <div class="bg-home" style="background-image: url({{ asset(auth()->user()->bg_home) }});">
        <div class="container">
            <span class="btn btn-dark border-0">更换封面</span>
        </div>
    </div>
    <div class="bg-white nav-user">
        <div class="container">
            @include('www.home.nav')
        </div>
    </div>
    <div class="container clearfix">
        <div class="bg-white home-user float-left">
            <p class="text-center avatar">
                <span class="d-block mb-2">
                    <img class="rounded-circle" src="{{ asset(auth()->user()->avatar) }}" alt="头像" width="120" height="120">
                </span>
                <i class="fa {{ auth()->user()->sex === 'F' ? 'fa-venus text-danger' : 'fa-mars text-primary' }} fa-lg"></i> {{ auth()->user()->name ?? auth()->user()->mobile }}
            </p>
            <p class="bg-light p-3 text-muted">
                <span class="d-block mb-2">现居：{{ auth()->user()->province ?? '未知' }} / {{ auth()->user()->city ?? '未知' }}</span>
                {{ auth()->user()->description ?? '这家伙太懒了，还没有完善个人信息。' }}
            </p>
            <table class="table table-bordered text-center">
                <tr>
                    <td class="w-50">
                        <b>{{ auth()->user()->follows()->count() }}</b>
                        <br>关注
                    </td>
                    <td class="w-50">
                        <b>{{ auth()->user()->fans()->count() }}</b>
                        <br>粉丝
                    </td>
                </tr>
            </table>
        </div>

        @unless(auth()->user()->description)
            <div class="home-travels float-right mt-4 p-4" style="background: #FFF100;">
                <p class="text-dark mb-4">
                    <span class="text-info h5 mb-0">{{ auth()->user()->name ?? auth()->user()->mobile }}</span>，欢迎来到遇途记！
                    <br>这里是记录你的旅行记忆的地盘儿，快点开启属于你的遇途记吧！
                </p>
                <p class="text-center">
                    <a href="{{ url('home/setting') }}" class="mr-3"><img src="{{ asset('img/empty_userinfo.png') }}" alt="empty_userinfo" width="347" height="102"></a>
                    <a href="{{ route('travel.create') }}" class="ml-3"><img src="{{ asset('img/empty_youji.png') }}" alt="empty_youji" width="347" height="102"></a>
                </p>
            </div>
        @endunless

        <div class="bg-white home-travels float-right mt-4">
            @yield('body')
        </div>
    </div>
@endsection
