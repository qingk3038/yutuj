@if(isset($theme) && $theme== 'white')
    <header class="position-absolute bg-white container-fluid">
        <div class="text-warning row">
            <span class="col-3" onclick="history.back();"><i class="fas fa-lg fa-angle-left"></i></span>
            <span class="col text-center">{{ $title }}</span>
            <div class="col-3 text-right">
                @guest
                    <a href="{{ route('login') }}" class="text-warning">
                        <i class="fa fa-fw fa-user"></i>
                    </a>
                @else
                    <a href="{{ route('home') }}">
                        <img class="rounded-circle" src="{{ auth()->user()->avatar }}" alt="avatar" width="22" height="22">
                    </a>
                @endguest
                <a href="#menu" data-toggle="collapse" class="text-warning align-middle">
                    <i class="fa fa-fw fa-align-justify"></i>
                </a>
            </div>
        </div>
    </header>
@else
    <header class="position-absolute container-fluid">
        <div class="text-white row">
            <span class="col-3" onclick="history.back();"><i class="fas fa-lg fa-angle-left"></i></span>
            <span class="col text-center">{{ $title }}</span>
            <div class="col-3 text-right">
                @auth
                    <a href="{{ route('home') }}"><img class="rounded-circle" src="{{ auth()->user()->avatar }}" alt="avatar" width="22" height="22"></a>
                @else
                    <a href="{{ route('login') }}"> <i class="fa fa-fw fa-user"></i></a>
                @endauth
                <a href="#menu" data-toggle="collapse" class="align-middle">
                    <i class="fa fa-fw fa-align-justify"></i>
                </a>
            </div>
        </div>
    </header>
@endif

<nav class="collapse font-weight-light position-absolute" id="menu">
    <a href="{{ url('/') }}">首页</a>
    <a href="{{ route('activity.list', ['nid' => 2]) }}">纵横西部</a>
    <a href="{{ route('activity.list', ['nid' => 3]) }}">微上西部</a>
    <a href="{{ route('activity.list', ['nid' => 4]) }}">超级周末</a>
    <a href="{{ route('activity.list', ['nid' => 5]) }}">最6旅行</a>
    <a href="{{ url('customized') }}">定制游</a>
    <a href="{{ route('activity.list') }}">活动</a>
    <a href="{{ route('raider.list') }}">攻略</a>
    <a href="{{ route('travel.list') }}">游记</a>
    <a href="{{ route('leader.list') }}">大咖领路</a>
    <a href="{{ route('video.list') }}">旅拍直播</a>
    <a href="{{ route('article.show', 1) }}">关于我们</a>
</nav>