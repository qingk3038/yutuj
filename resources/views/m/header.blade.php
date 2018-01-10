<header class="position-absolute bg-white">
    <div class="text-warning d-flex justify-content-between">
        <span onclick="history.back();"><i class="fas fa-lg fa-angle-left"></i></span>
        <span>{{ $title }}</span>
        <div>
            @guest
                <a href="{{ route('login') }}">
                    <i class="fa fa-fw fa-user"></i>
                </a>
            @else
                <a href="{{ route('home') }}">
                    <img class="rounded-circle" src="{{ auth()->user()->avatar }}" alt="avatar" width="22" height="22">
                </a>
            @endguest
            <a href="#menu" data-toggle="collapse">
                <i class="fa fa-fw fa-align-justify"></i>
            </a>
        </div>
    </div>
</header>
<nav class="collapse font-weight-light position-absolute" id="menu">
    <a href="#">纵横西部</a>
    <a href="#">微上西部</a>
    <a href="#">超级周末</a>
    <a href="#">最6旅行</a>
    <a href="#">定制游</a>
    <a href="#">活动</a>
    <a href="#">攻略</a>
    <a href="#">游记</a>
    <a href="#">大咖领路</a>
    <a href="#">旅拍直播</a>
    <a href="#">关于我们</a>
</nav>