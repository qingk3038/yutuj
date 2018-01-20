<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <title>@yield('title') | {{ config('web_title') }}</title>
    <meta name="author" content="bing,QQ676659348">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords" content="{{ config('web_keywords') }}">
    <meta name="description" content="{{ config('web_description') }}">

    {{--字体图标--}}
    <link href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    {{--VUE--}}
    <script src="https://cdn.bootcss.com/vue/2.5.13/vue.min.js"></script>
    <script src="https://cdn.bootcss.com/axios/0.17.1/axios.min.js"></script>

    {{--Bootstrap--}}
    <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://cdn.bootcss.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.bootcss.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>

    {{--弹窗组件--}}
    <link rel="stylesheet" href="{{ asset('vendor/laravel-admin/sweetalert/dist/sweetalert.css') }}">
    <script src="{{ asset('vendor/laravel-admin/sweetalert/dist/sweetalert.min.js') }}"></script>

    {{--WEB样式--}}
    <link rel="stylesheet" href="{{ asset('css/css.css') }}">
    <script src="{{ asset('js/bing.js') }}"></script>
</head>
<body>
@section('header')
    <header class="{{ Request::is('/') ? 'position-absolute head-index' : 'bg-white' }}">
        <div class="container">
            <nav class="navbar navbar-expand top-nav {{ Request::is('/') ? 'navbar-dark' : 'navbar-light' }}">
                <a class="navbar-brand" href="{{ url('/') }}">
                    @if(Request::is('/'))
                        <img src="{{ asset('img/logo_index.png') }}" width="148" height="50" alt="logo_index">
                    @else
                        <img src="{{ asset('img/logo_top.png') }}" width="148" height="50" alt="top_logo">
                    @endif
                </a>
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">首页 <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="{{ route('activity.list') }}" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            旅行
                        </a>
                        <div class="dropdown-menu rounded-0 {{ Request::is('/') ? 'index-down' : 'other-down' }}">
                            <a class="dropdown-item" href="{{ route('activity.list', ['nid' => 2]) }}"><i class="fa fa-fw fa-map-marker"></i> 纵横西部</a>
                            <a class="dropdown-item" href="{{ route('activity.list', ['nid' => 3]) }}"><i class="fa fa-fw fa-paw"></i> 微上西部</a>
                            <a class="dropdown-item" href="{{ route('activity.list', ['nid' => 4]) }}"><i class="fa fa-fw fa-photo"></i> 超级周末</a>
                            <a class="dropdown-item" href="{{ route('activity.list', ['nid' => 5]) }}"><i class="fa fa-fw fa-institution"></i> 最6旅行</a>
                        </div>
                    </li>
                    <li class="nav-item {{ Request::is('customized') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('customized') }}">定制游</a>
                    </li>
                    <li class="nav-item {{ Route::is('www.activity*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('activity.list') }}">活动</a>
                    </li>
                    <li class="nav-item {{ Route::is('www.raider*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('raider.list') }}">攻略</a>
                    </li>
                    <li class="nav-item {{ Route::is('www.travel*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('travel.list') }}">游记</a>
                    </li>
                    <li class="nav-item {{ Route::is('www.leader*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('leader.list') }}">大咖领路</a>
                    </li>
                    <li class="nav-item {{ Route::is('www.video*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('video.list') }}">旅拍直播</a>
                    </li>
                </ul>

                @if(Request::is('/'))
                    <div class="text-white pr-5">
                        <i class="fa fa-fw fa-phone"></i> {{ config('tel_400') }}
                    </div>
                @else
                    <form class="form-inline mr-4 top-search" autocomplete="off" action="{{ url('search') }}">
                        <div class="input-group">
                            <div class="input-group-btn">
                                <button type="button" id="search-btn" class="btn dropdown-toggle down" data-toggle="dropdown">不限</button>
                                <div class="dropdown-menu rounded-0 other-down no-line">
                                    <a class="dropdown-item search-item" href="javascript:void(0);">不限</a>
                                    @foreach($searchProvinces as $province)
                                        <a class="dropdown-item search-item" href="javascript:void(0);" pid="{{ $province->id }}">{{ $province->name }}</a>
                                    @endforeach
                                </div>
                            </div>
                            <input type="hidden" name="pid" id="pid" value="{{ request('pid') }}">
                            <input type="text" class="form-control" name="q" id="q" placeholder="搜目的地/攻略/游记" value="{{ request('q') }}" style="border-right: none">
                            <button type="submit" class="input-group-addon submit"><i class="fa fa-search text-warning fa-lg"></i></button>
                        </div>
                    </form>
                @endif

                <div class="user-info">
                    @guest
                        @if(Request::is('/'))
                            <a href="{{ url('login') }}" class="text-white">登录</a> | <a href="{{ url('register') }}" class="text-white">注册</a>
                        @else
                            <a href="{{ url('login') }}" class="text-warning">登录</a> | <a href="{{ url('register') }}" class="text-warning">注册</a>
                        @endif
                    @else
                        <div data-toggle="dropdown" style="cursor:pointer;" class="{{ Request::is('/') ? 'text-white' : '' }}">
                            <img class="rounded-circle" src="{{ auth()->user()->avatar }}" alt="头像" width="36" height="36">
                            {{ str_limit(auth()->user()->name, 10) ?? auth()->user()->mobile }}
                        </div>
                        <div class="dropdown">
                            <div class="dropdown-menu rounded-0 {{ Request::is('/') ? 'index-down' : 'other-down' }}">
                                <a class="dropdown-item" href="{{ route('home.setting') }}"><i class="fa fa-fw fa-user"></i> 个人中心</a>
                                <a class="dropdown-item" href="{{ url('home/order') }}"><i class="fa fa-fw fa-list-alt"></i> 我的订单</a>
                                <a class="dropdown-item" href="{{ route('home.travel.index') }}"><i class="fa fa-fw fa-book"></i> 我的游记</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"><i class="fa fa-fw fa-sign-out"></i> 退出</a>
                            </div>
                        </div>
                    @endguest
                </div>
            </nav>
        </div>
    </header>
@show

@yield('content')

@section('footer')
    <footer>
        <div class="container">
            <nav class="nav nav-justified">
                <a class="nav-item nav-link" href="{{ url('/') }}">首页</a>
                <a class="nav-item nav-link" href="{{ route('activity.list', ['nid' => 2]) }}">纵横西部</a>
                <a class="nav-item nav-link" href="{{ route('activity.list', ['nid' => 3]) }}">微上西部</a>
                <a class="nav-item nav-link" href="{{ route('activity.list', ['nid' => 4]) }}">超级周末</a>
                <a class="nav-item nav-link" href="{{ route('activity.list', ['nid' => 5]) }}">最6旅行</a>
                <a class="nav-item nav-link" href="{{ url('customized') }}">定制旅行</a>
                <a class="nav-item nav-link" href="{{ route('raider.list') }}">超级攻略</a>
                <a class="nav-item nav-link" href="{{ route('travel.list') }}">精彩游记</a>
                <a class="nav-item nav-link" href="{{ route('leader.list') }}">大咖领路</a>
            </nav>
            <hr>
            <div class="row py-4 links">
                <div class="col-8">
                    <div class="row">
                        @foreach($categories as $category)
                            <div class="col-3">
                                <h6>{{ $category->title }}</h6>
                                @foreach($category->articles as $article)
                                    <a href="{{ route('article.show', $article) }}" target="_blank">{{ $article->title }}</a>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-4">
                    <div class="row">
                        <div class="col">
                            <img src="{{ asset('img/logo_footer.png') }}" alt="logo_footer" width="170" height="56">
                            <h4 class="text-center">{{ config('tel_400') }}</h4>
                            <span class="btn btn-warning btn-block text-white swt">在线咨询</span>
                        </div>
                        <div class="col text-center">
                            <img src="{{ asset('img/weixin.jpg') }}" alt="weixin" width="114" height="114">
                            <br>关注遇途记公众号
                        </div>
                    </div>
                </div>
            </div>
            <div class="about text-center">
                <p>
                    @foreach($abouts as $about)
                        <a href="{{ route('article.show', $about) }}" target="_blank">{{ $about->title }}</a>
                    @endforeach
                </p>
                <hr>
                <p>{{ config('web_footer') }}</p>
            </div>
        </div>
    </footer>
    <aside class="position-fixed side-right">
        <div class="mb-1 text-center">
            <span class="d-block" data-toggle="popover" data-placement="left" data-trigger="hover" data-html="true" data-content="<p class='mb-0 text-center'>客服电话</p><b>{{ config('tel_400') }}</b>">
                <i class="fa fa-fw fa-3x text-white fa-phone"></i>
            </span>
            <span class="d-block swt">
                <i class="fa fa-fw fa-3x text-white fa-commenting"></i>
            </span>
            <span class="d-block" data-toggle="popover" data-placement="left" data-trigger="hover" data-html="true" data-content="<p class='mb-1'><img src='{{ asset('img/aside_weixin.png') }}' width='158' height='158'></p><h5 class='text-center m-0'>关注遇途记</h5>更多优惠好玩旅行等你来">
                <i class="fa fa-fw fa-3x text-white fa-qrcode"></i>
            </span>
        </div>
        <div class="top text-center">
            <i class="fa fa-fw fa-3x text-white fa-angle-up"></i>
        </div>
    </aside>
@show

@stack('script')
{!! config('js_pc') !!}
</body>
</html>