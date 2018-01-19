@extends('layouts.m')

@section('title', '报名流程-第2步：订单支付')

@section('header')
    <header class="position-sticky text-warning container-fluid">
        <div class="row">
            <span class="col-3" onclick="history.back();"><i class="fas fa-lg fa-angle-left"></i></span>
            <span class="col text-center">订单支付</span>
            <a class="col-3 text-right" href="{{ route('home') }}"><img class="rounded-circle" src="{{ auth()->user()->avatar }}" alt="avatar" width="22" height="22"></a>
        </div>
    </header>
@endsection

@section('content')
    <div class="py-4 bg-light text-center">
        <img src="{{ asset('m/img/step_2.png') }}" alt="step_2" width="285" height="64">
    </div>
    <div class="p-4 bg-light mt-3 small">
        <dl class="row">
            <dt class="col-3 offset-2">支付金额</dt>
            <dd class="col-7 text-danger">¥{{ number_format($order->money(), 2) }}</dd>

            <dt class="col-3 offset-2">订单号</dt>
            <dd class="col-7">{{ $order->out_trade_no  }}</dd>

            <dt class="col-3 offset-2">产品名称</dt>
            <dd class="col-7">{{ $order->tuan->activity->title }}</dd>
        </dl>
        <p class="text-center"><a href="{{ route('order.pay', $order)  }}" class="btn btn-sm btn-success px-4 btn-pay">立即支付</a></p>
    </div>
@endsection

@section('footer', false)

@push('script')
    <script>
        window.setTimeout(checkStatus, 3000)

        function checkStatus() {
            axios.get("{{ route('pay.status', $order) }}").then(res => {
                switch (res.data.status) {
                    case 'wait' :
                        window.setTimeout(checkStatus, 3000);
                        break;

                    case 'success' :
                        swal({
                            title: '干得漂亮，支付成功！',
                            text: '我们已经收到了你的支付款，请等待旅行顾问与您联系。',
                            type: 'success'
                        }, () => {
                            location.reload()
                        })
                        break;

                    case 'fail' :
                        swal({
                            title: '对不起，支付失败！',
                            text: '本次支付失败，请你重新下单。',
                            type: 'error'
                        }, () => {
                            location.reload()
                        })
                        break;

                    case 'close' :
                        swal({
                            title: '订单已经关闭！',
                            text: '请你重新下单。',
                            type: 'warning'
                        }, () => {
                            location.reload()
                        })
                        break;

                    default :

                }
            }).catch(err => {
                console.log(err)
            })
        }
    </script>
@endpush