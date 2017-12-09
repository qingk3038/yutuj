<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <title>@yield('title'){{ config('web_title') }}</title>
    <meta name="author" content="bing,QQ676659348">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords" content="{{ config('web_keywords') }}">
    <meta name="description" content="{{ config('web_description') }}">
    <link href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdn.bootcss.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.bootcss.com/vue/2.5.9/vue.js"></script>
    <script src="https://cdn.bootcss.com/axios/0.17.1/axios.min.js"></script>
    <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/bootstrap/4.0.0-beta.2/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/css.css') }}">
    <script src="{{ asset('js/bing.js') }}"></script>
</head>
<body>
<div id="app">
    @section('header')
        <header class="bg-white">
            <div class="container">
                <nav class="navbar navbar-expand navbar-light top-nav">
                    <a class="navbar-brand" href="#">
                        <img src="{{ asset('img/logo_top.png') }}" width="148" height="50" alt="top_logo">
                    </a>
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ url('/') }}">首页 <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                旅行
                            </a>
                            <div class="dropdown-menu rounded-0 other-down">
                                <a class="dropdown-item" href="#"><i class="fa fa-fw fa-map-marker"></i> 纵横西部</a>
                                <a class="dropdown-item" href="#"><i class="fa fa-fw fa-paw"></i> 西行漫游</a>
                                <a class="dropdown-item" href="#"><i class="fa fa-fw fa-photo"></i> 超级周末</a>
                                <a class="dropdown-item" href="#"><i class="fa fa-fw fa-institution"></i> 最6旅行</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">定制游</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">活动</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">攻略</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">游记</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">大咖领路</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">旅拍直播</a>
                        </li>
                    </ul>
                    <form class="form-inline mr-4 top-search">
                        <div class="input-group">
                            <div class="input-group-btn">
                                <button type="button" class="btn dropdown-toggle down" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    四川
                                </button>
                                <div class="dropdown-menu rounded-0 other-down no-line">
                                    <a class="dropdown-item" href="#">不限</a>
                                    <a class="dropdown-item" href="#">四川</a>
                                    <a class="dropdown-item" href="#">青海</a>
                                    <a class="dropdown-item" href="#">西藏</a>
                                    <a class="dropdown-item" href="#">新疆</a>
                                    <a class="dropdown-item" href="#">内蒙古</a>
                                    <a class="dropdown-item" href="#">陕甘宁</a>
                                </div>
                            </div>
                            <input type="text" class="form-control" placeholder="搜目的地/攻略/游记" style="border-right: none">
                            <button type="submit" class="input-group-addon submit"><i class="fa fa-search text-warning fa-lg"></i></button>
                        </div>
                    </form>
                    <div class="user-info">
                        @guest
                            <a href="{{ url('login') }}" class="text-warning">登录</a> | <a href="{{ url('register') }}" class="text-warning">注册</a>
                        @else
                            <div data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="cursor:pointer;">
                                <img class="rounded-circle" src="{{ asset(auth()->user()->avatar) }}" alt="头像" width="36" height="36">
                                {{ str_limit(auth()->user()->name, 10) ?? auth()->user()->mobile }}
                            </div>
                            <div class="dropdown">
                                <div class="dropdown-menu rounded-0 other-down">
                                    <a class="dropdown-item" href="{{ url('home/setting') }}"><i class="fa fa-fw fa-user"></i> 个人中心</a>
                                    <a class="dropdown-item" href="{{ url('home/order') }}"><i class="fa fa-fw fa-list-alt"></i> 我的订单</a>
                                    <a class="dropdown-item" href="{{ url('home') }}"><i class="fa fa-fw fa-book"></i> 我的游记</a>
                                    <a class="dropdown-item" href="{{ url('logout') }}"><i class="fa fa-fw fa-sign-out"></i> 退出</a>
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
                    <a class="nav-item nav-link" href="#">首页</a>
                    <a class="nav-item nav-link active" href="#">纵横西部</a>
                    <a class="nav-item nav-link" href="#">西行漫游</a>
                    <a class="nav-item nav-link" href="#">超级周末</a>
                    <a class="nav-item nav-link" href="#">最6旅行</a>
                    <a class="nav-item nav-link" href="#">定制旅行</a>
                    <a class="nav-item nav-link" href="#">超级攻略</a>
                    <a class="nav-item nav-link" href="#">精彩游记</a>
                    <a class="nav-item nav-link" href="#">大咖领路</a>
                </nav>
                <hr>
                <div class="row py-4 links">
                    <div class="col-8">
                        <div class="row">
                            <div class="col-3">
                                <h6>活动报名流程</h6>
                                <a href="#">报名须知</a>
                                <a href="#">网上报名信息修改</a>
                                <a href="#">网上报名流程及状态</a>
                                <a href="#">报名方式</a>
                                <a href="#">网上报名费用支付问题</a>
                            </div>
                            <div class="col-3">
                                <h6>预订常见问题</h6>
                                <a href="#">遇到恶劣天气是否取消？遇到恶劣天气是否取消遇到恶劣天气是否取消遇到恶劣天气是否取消</a>
                                <a href="#">必须填写身份证吗？</a>
                                <a href="#">独立成团可以吗？</a>
                                <a href="#">什么是单房差？</a>
                                <a href="#">纯玩是什么意思？</a>
                            </div>
                            <div class="col-3">
                                <h6>网站条款</h6>
                                <a href="#">网站免责声明</a>
                                <a href="#">网站用户协议</a>
                                <a href="#">网站版权说明</a>
                                <a href="#">签订旅游合同</a>
                            </div>
                            <div class="col-3">
                                <h6>付款和发票</h6>
                                <a href="#">付款流程</a>
                                <a href="#">三种付款方式</a>
                                <a href="#">发票相关问题</a>
                                <a href="#">如何支付尾款</a>
                                <a href="#">退款付款说明</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="row">
                            <div class="col">
                                <img src="{{ asset('img/logo_footer.png') }}" alt="logo_footer" width="170" height="56">
                                <h4 class="text-center">400-3455-456</h4>
                                <span class="btn btn-warning btn-block text-white">在线咨询</span>
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
                        <a href="#">关于我们</a>
                        <a href="#">人才招聘</a>
                        <a href="#">帮助中心</a>
                        <a href="#">网站地图</a>
                        <a href="#">商务洽谈</a>
                        <a href="#">营业执照</a>
                    </p>
                    <hr>
                    <p>{{ config('web_footer') }}</p>
                </div>
            </div>
        </footer>
        <aside class="position-fixed side-right">
            <div class="mb-1 text-center">
            <span class="d-block" data-toggle="popover" data-placement="left" data-trigger="hover" data-html="true" data-content="<p class='mb-0 text-center'>客服电话</p><b>400-3455-456</b>">
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
</div>
@stack('script')
</body>
</html>