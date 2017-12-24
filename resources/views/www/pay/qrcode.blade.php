@extends('layouts.app')

@section('title', '报名流程-第2步：订单支付')

@section('content')
    <div class="container-fluid bg-warning">
        <h3 class="text-white text-center" style="padding-top: 160px; padding-bottom: 100px;">订单支付</h3>
    </div>
    <div class="container" id="app">
        <div class="bg-white px-5 py-2" style="margin-top: -80px;">
            <div class="text-center"><img src="{{ asset('img/step_pay_2.png') }}" alt="报名第2步"></div>
            <hr class="mt-1">
            <div class="d-flex justify-content-center">
                <div class="pay_select">
                    支付方式：
                    <div @click="changePay('alipay')" :class="{active: type === 'alipay'}">
                        <img src="{{ asset('img/pay_ali.jpg') }}" alt="aliPay">
                        <span></span>
                    </div>
                    <div @click="changePay('wechat')" :class="{active: type === 'wechat'}">
                        <img src="{{ asset('img/pay_weixin.jpg') }}" alt="pay wechat">
                        <span></span>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-center text-center p-5" v-if="type === 'alipay'">
                <div class="pr-4">
                    <p><img src="{{ asset('img/pay_ali_left.jpg') }}" alt="pay_ali_left"></p>
                    无法通过手机支付的，您可以选择 <a href="#" class="text-warning">电脑在线支付</a>
                </div>
                <div class="pt-3 pl-5">
                    <p><img src="{{ asset('uploads/d/qrcode.jpg') }}" alt="qrcode" width="268" height="268"></p>
                    用支付宝扫描二维码支付
                </div>
            </div>
            <div class="d-flex justify-content-center text-center p-5" v-if="type === 'wechat'">
                <div class="pr-4">
                    <p><img src="{{ asset('img/pay_weixin_left.jpg') }}" alt="pay_ali_left"></p>
                    无法通过微信支付的，您可以选择 <a href="javascript:void(0);" class="text-warning" @click="changePay('alipay')">支付宝支付</a>
                </div>
                <div class="pt-3 pl-5">
                    <p><img src="{{ route('pay.wechat', $order) }}" alt="微信支付" width="268" height="268"></p>
                    用微信扫描二维码支付
                </div>
            </div>
            <p class="text-danger text-center">请注意，如果你正在支付中，在未结束之前不要切换[支付方式].</p>
        </div>
    </div>
@endsection

@push('script')
    <script>
        new Vue({
            el: '#app',
            data: {
                url: "{{ route('pay.status', $order) }}",
                type: 'wechat'
            },
            methods: {
                changePay(e) {
                    this.type = e
                },
                refreshStatus() {
                    window.setTimeout(() => {
                        axios.get(this.url).then(res => {
                            switch (res.data.status) {
                                case 'wait' :
                                    window.setTimeout(this.refreshStatus, 300);
                                    console.log('继续等待支付。')
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
                    }, 3000)
                }
            },
            mounted() {
                this.refreshStatus()
            }
        })
    </script>
@endpush