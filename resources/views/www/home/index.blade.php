@extends('layouts.app')

@section('title', ($user->name ?? $user->mobile) . '的个人主页')

@section('content')
    <div class="bg-home" style="background-image: url({{ asset($user->bg_home) }});">
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
                    <img class="rounded-circle" src="{{ asset($user->avatar) }}" alt="头像" width="120" height="120">
                </span>
                <i class="fa {{ $user->sex === 'F' ? 'fa-venus text-danger' : 'fa-mars text-primary' }} fa-lg"></i> {{ $user->name ?? $user->mobile }}
            </p>
            <p class="bg-light p-3 text-muted">
                <span class="d-block mb-2">现居：{{ $user->province ?? '未知' }} / {{ $user->city ?? '未知' }}</span>
                {{ $user->description ?? '这家伙太懒了，还没有完善个人信息。' }}
            </p>
            <table class="table table-bordered text-center">
                <tr>
                    <td class="w-50">
                        <b>{{ $user->follows()->count() }}</b>
                        <br>关注
                    </td>
                    <td class="w-50">
                        <b>{{ $user->fans()->count() }}</b>
                        <br>粉丝
                    </td>
                </tr>
            </table>
        </div>

        @unless($user->description)
            <div class="home-travels float-right mt-4 p-4" style="background: #FFF100;">
                <p class="text-dark mb-4">
                    <span class="text-info h5 mb-0">{{ $user->name ?? $user->mobile }}</span>，欢迎来到遇途记！
                    <br>这里是记录你的旅行记忆的地盘儿，快点开启属于你的遇途记吧！
                </p>
                <p class="text-center">
                    <a href="{{ url('home/setting') }}" class="mr-3"><img src="{{ asset('img/empty_userinfo.png') }}" alt="empty_userinfo" width="347" height="102"></a>
                    <a href="{{ url('home/release') }}" class="ml-3"><img src="{{ asset('img/empty_youji.png') }}" alt="empty_youji" width="347" height="102"></a>
                </p>
            </div>
        @endunless

        <div class="bg-white home-travels float-right mt-4">
            <div class="d-flex justify-content-between p-3">
                <span class="h5">我的游记</span>
                <a href="{{ url('home/release') }}" class="btn btn-warning text-white px-3 py-1"><i class="fa fa-edit"></i> 发表游记</a>
            </div>

            @unless($travels->total())
                <div class="bg-light p-5 text-center"><img src="{{ asset('img/empty_release.png') }}" alt="empty_release" width="140" height="125"></div>
            @else

                <div class="card">
                    <div class="position-relative">
                        <img class="card-img-top" src="{{ asset('uploads/d/thumb_youji.jpg') }}" alt="Card image cap">
                        <div class="position-absolute p-3 btns d-flex">
                            <a href="#" class="btn btn-dark border-0 mr-auto"><i class="fa fa-trash-o"></i> 删除</a>
                            <a href="#" class="btn btn-dark border-0 mr-2"><i class="fa fa-edit"></i> 编辑</a>
                            <a href="#" class="btn btn-dark border-0"><i class="fa fa-photo"></i> 设置封面</a>
                        </div>
                    </div>
                    <div class="card-body position-relative">
                        <div class="position-absolute up">
                            334
                            <span class="fa-stack fa-lg">
                        <i class="fa fa-circle fa-stack-2x text-info"></i>
                        <i class="fa fa-thumbs-o-up fa-stack-1x fa-inverse"></i>
                    </span>
                        </div>
                        <h5 class="card-title">90年代，四进上海，说好的事不过三呢</h5>
                        <p class="text-muted">
                            <i class="fa fa-fw fa-map-marker"></i>上海
                            <i class="fa fa-fw fa-eye"></i>10400
                            <i class="fa fa-fw fa-clock-o"></i>2017-05-24
                        </p>
                        <p class="card-text text-justify">在上世纪的90年代，我曾四次到上海。分别是1991年、1992年、1998年和1999年。第一次是1991年，那次是去庐山，因为天津当时没有直接到九江的火车，所以要到上海中转。在上海去了外滩、南京路、大世界、城隍庙旅游区（没有进豫园），还坐游船游览了黄浦江。去的时候因为是6月份，已经很热了，逛街的时候，看到有冷面馆，很多人在吃……</p>
                    </div>
                </div>

                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        {{ $travels->links() }}
                    </ul>
                </nav>
            @endunless
        </div>
    </div>
@endsection
