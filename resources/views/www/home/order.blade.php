@extends('layouts.home')

@section('body')
    <h5 class="px-3 pt-3 m-0">我的订单</h5>
    <div id="load">
        @if(auth()->user()->orders()->count())
            <div>
                <hr>
            </div>
            <div class="px-4">
                <ul class="nav nav-pills nav-order">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::has('status') || Request::has('tno') ? '' : 'active' }}" href="{{ route('home.order') }}">全部</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::get('status') === 'wait' ? 'active' : '' }}" href="{{ route('home.order', ['status' => 'wait']) }}">待支付</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::get('tno') ? 'active' : '' }}" href="{{ route('home.order', ['tno' => 1]) }}">待出行</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::get('status') === 'cancel' ? 'active' : '' }}" href="{{ route('home.order', ['status' => 'cancel']) }}">取消/退款</a>
                    </li>
                </ul>
                <table class="table list-order mt-3">
                    <tr>
                        <th class="text-center" colspan="2">订单信息</th>
                        <th>数量</th>
                        <th>总价</th>
                        <th>订单状态</th>
                        <th>订单号</th>
                    </tr>
                    @foreach($orders as $order)
                        <tr>
                            <td><img src="{{ imageCut(80, 50, $order->tuan->activity->thumb) }}" alt="{{ $order->tuan->activity->title }}" width="82" height="51"></td>
                            <td>
                                <a href="{{ route('home.order.show', $order) }}" class="d-block">{{ str_limit($order->tuan->activity->title, 50) }}</a>
                                {{ $order->tuan->start_time->toDateString() }}
                            </td>
                            <td>{{ $order->baomings_count }}</td>
                            <td>￥{{ $order->baomings_count * $order->tuan->price }}</td>
                            <td>
                                {{ $order->statusText() }}
                                @if($order->status === 'wait')<a href="{{ route('order.qrcode', $order) }}" target="_blank" class="text-warning d-block">去支付</a>@endif
                            </td>
                            <td>{{ $order->out_trade_no }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <nav class="d-flex justify-content-center px-3">
                {{ $orders->appends(Request::only('status', 'travel'))->links() }}
            </nav>
        @else
            <div class="bg-light p-5 mt-4 text-center"><img src="{{ asset('img/empty_order.png') }}" alt="empty_order" width="140" height="125"></div>
        @endif
    </div>
@endsection

@push('script')
    <script>
        (function ($) {
            // 异步加载
            $(document).on('click', '.nav-order a, ul.pagination a', function (event) {
                event.preventDefault()
                let url = $(this).attr('href') + ' #load > div'
                $('#load').load(url, function () {
                    $('body,html').animate({scrollTop: $(this).offset().top}, 500)
                })
            })
        })(jQuery);
    </script>
@endpush