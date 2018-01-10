<nav class="nav">
    <a class="nav-link {{ Route::is('home.travel*') ? 'active' : ''}}" href="{{ route('home.travel.index') }}">我的游记</a>
    <a class="nav-link {{ Route::is('home.message') ? 'active' : ''}}" href="{{ route('home.message') }}">我的消息</a>
    <a class="nav-link {{ Route::is('home.order*') ? 'active' : ''}}" href="{{ url('home/order') }}">我的订单</a>
    <a class="nav-link {{ Route::is('home.setting') ? 'active' : ''}}" href="{{ route('home.setting') }}">设置中心</a>
</nav>