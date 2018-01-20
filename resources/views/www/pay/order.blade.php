@extends('layouts.app')

@section('title', '报名流程-第1步：填写信息')

@section('content')
    <div class="container-fluid bg-warning">
        <h3 class="text-white text-center" style="padding-top: 160px; padding-bottom: 100px;">填写报名信息</h3>
    </div>
    <div class="container" id="app">
        <div class="bg-white px-5 py-2" style="margin-top: -80px;">
            <div class="text-center"><img src="{{ asset('img/step_pay_1.png') }}" alt="step_pay_1"></div>
            <hr class="mt-1">
            <h3 class="p-3">{{ $tuan->activity->title }}</h3>

            <p class="lead bg-light p-2">活动信息</p>
            <dl class="row px-2">
                <dd class="col-4">集合地：{{ $tuan->activity->cfd }}</dd>
                <dd class="col-8">目的地：{{ $tuan->activity->country->name }} {{ $tuan->activity->province->name }} {{ $tuan->activity->city->name ?? '' }}  {{ $tuan->activity->district->name ?? '' }} </dd>

                <dd class="col-4">开始时间：{{ $tuan->activity->created_at->toDateString() }}</dd>
                <dd class="col-8">天数：{{ $tuan->activity->trips()->count() }}</dd>

                <dd class="col-4">选择批次：{{ $tuan->start_time->toDateString() }} — {{ $tuan->end_time->toDateString() }}</dd>
                <dd class="col-8">费用：<span class="text-danger">￥{{ $tuan->price }}/人</span></dd>
            </dl>

            <p class="lead bg-light p-2">报名人信息
                <small class="text-muted">（本活动的相关通知会通知第1个报名人，请留意手机短息并准确填写报名人信息，一遍办理各种手续和购买保险）</small>
            </p>
            @verbatim
                <el-form class="order-form" :model="order" ref="order" v-loading="seed" element-loading-text="正在提交订单……">
                    <div class="position-relative num-info" v-for="(user, index) in order.users">
                        <div class="d-flex justify-content-between position-absolute">
                            <span class="text-white num">第{{ index + 1 }}个报名人</span>
                            <span class="close p-2" v-if="index > 0" @click="removeUser(index)">&times;</span>
                        </div>
                        <el-form-item label-width="100px" label="真实姓名" :prop="'users.' + index + '.name'" :rules="[{ required: true, message: '请输入报名人真实姓名'},{ min: 2, max: 10, message: '真实姓名在2-10位' }]">
                            <el-input v-model="user.name" placeholder="请输入真实姓名"></el-input>
                        </el-form-item>
                        <el-form-item label-width="100px" label="手机号码" :prop="'users.' + index + '.mobile'" :rules="[{ required: true, message: '请输入11位手机号码'},{ min: 11, max: 11, message: '手机号应该11位' }]">
                            <el-input v-model="user.mobile" placeholder="请输入手机号码"></el-input>
                        </el-form-item>

                        <el-form-item label-width="100px" label="证件信息" :prop="'users.' + index + '.cardID'" :rules="[{ required: true, message: '请输入证件号码'}]">
                            <el-input class="input-with-select" placeholder="请输入证件号码" v-model="user.cardID">
                                <el-select slot="prepend" v-model="user.cardType" placeholder="请选择">
                                    <el-option v-for="item in cardTypes" :key="item.value" :label="item.label" :value="item.value"></el-option>
                                </el-select>
                            </el-input>
                        </el-form-item>

                        <el-form-item label-width="100px" label="紧急联系人" :prop="'users.' + index + '.nameJ'" :rules="[{ required: true, message: '请输入紧急联系人姓名'},{ min: 2, max: 10, message: '姓名在2-10位' }]">
                            <el-input v-model="user.nameJ" placeholder="请输入联系人姓名"></el-input>
                        </el-form-item>
                        <el-form-item label-width="100px" label="联系人电话" :prop="'users.' + index + '.mobileJ'" :rules="[{ required: true, message: '请输入11位手机号码'},{ min: 11, max: 11, message: '手机号应该11位' }]">
                            <el-input v-model="user.mobileJ" placeholder="请输入紧急联系人电话"></el-input>
                        </el-form-item>
                    </div>

                    <el-form-item>
                        <el-button type="warning" @click="addUser">+新增报名人员</el-button>
                    </el-form-item>

                    <p class="lead bg-light p-2">订单备注</p>
                    <el-form-item>
                        <el-input type="textarea" v-model="order.remarks" placeholder="最多可输入50个字"></el-input>
                    </el-form-item>

                    <div class="d-flex justify-content-between">
                        <div class="pay_select">
                            支付方式：
                            <div @click="changePay('alipay')" :class="{active: order.type === 'alipay'}">
                                <img src="../img/pay_ali.jpg" alt="pay_ali">
                                <span></span>
                            </div>
                            <div @click="changePay('wechat')" :class="{active: order.type === 'wechat'}">
                                <img src="../img/pay_weixin.jpg" alt="pay_weixin">
                                <span></span>
                            </div>
                        </div>
                        <div class="pt-3">
                            <span class="text-muted">共 {{ order.users.length }}人</span>
                            总金额：<b class="text-danger">￥{{ order.users.length * price }}</b>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-4">
                        <label>
                            <input type="checkbox" v-model="agreement"> 我已阅读并同意 <span class="text-warning">《遇途记服务协议》</span>
                        </label>
                        <button type="button" @click="submitForm" class="btn btn-danger px-5">提交订单</button>
                    </div>
                </el-form>
            @endverbatim
        </div>
    </div>
@endsection

@push('script')
    <link href="https://cdn.bootcss.com/element-ui/2.0.7/theme-chalk/index.css" rel="stylesheet">
    <script src="https://cdn.bootcss.com/element-ui/2.0.7/index.js"></script>
    <style>
        .el-select .el-input {
            width: 100px;
        }

        .input-with-select .el-input-group__prepend {
            background-color: #fff;
        }
    </style>
    <script>
        let user = {name: null, mobile: null, cardType: 'ID', cardID: null, nameJ: null, mobileJ: null}
        new Vue({
            el: '#app',
            data: {
                order: {
                    users: [
                        $.extend({}, user)
                    ],
                    remarks: null,
                    type: 'alipay',
                },
                cardTypes: [
                    {label: '身份证', value: 'ID'},
                    {label: '军官证', value: 'officer'},
                    {label: '护照', value: 'passport'},
                ],
                seed: false,
                agreement: true,
                max: {{ $tuan->remainder() }},
                price: {{ $tuan->price }}
            },
            methods: {
                addUser() {
                    if (this.max > this.order.users.length) {
                        this.order.users.push($.extend({}, user))
                    } else {
                        swal('当前活动批次名额有限！', `当前最多可报名 ${this.max} 个。`, 'warning')
                    }
                },
                removeUser(index) {
                    this.order.users.splice(index, 1)
                },
                changePay(e) {
                    this.order.type = e
                },
                submitForm() {
                    if (!this.agreement) {
                        swal('现在无法为你提交！', '你需要同意《遇途记服务协议》方可继续', 'warning')
                        return false
                    }

                    this.$refs.order.validate(valid => {
                        if (valid) {
                            this.seed = true
                            axios.post('', this.order).then(res => {
                                this.seed = false
                                location.href = res.data.path
                            }).catch(err => {
                                this.seed = false
                                let text = err.response.status === 401 ? '你还未认证！' : Object.values(err.response.data.errors).join("\r\n");
                                swal('你的提交未成功！', text, 'error')
                            })
                        } else {
                            this.$message({
                                showClose: true,
                                message: '请认真的完成页面信息',
                                type: 'error'
                            });
                            return false
                        }
                    })
                },
                tipsLogin() {
                    swal({
                        title: '登录提醒',
                        text: '游客你好，本活动登录后方可报名！',
                        type: 'warning'
                    }, () => {
                        let openUrl = "{{ route('login') }}";
                        let iWidth = 800
                        let iHeight = 700
                        let iTop = (window.screen.availHeight - 30 - iHeight) / 2;
                        let iLeft = (window.screen.availWidth - 10 - iWidth) / 2;
                        window.open(openUrl, 'login', `width=${iWidth},height=${iHeight},top=${iTop},left=${iLeft},scrollbars=no`)
                    })
                }
            },
            mounted() {
                @guest
                    this.tipsLogin()
                @endguest
            }
        })
    </script>
@endpush