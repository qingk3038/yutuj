@extends('layouts.m')

@section('title', '报名流程-第1步：填写信息')

@section('header')
    <header class="position-sticky text-warning container-fluid">
        <div class="row">
            <span class="col-3" onclick="history.back();"><i class="fas fa-lg fa-angle-left"></i></span>
            <span class="col text-center">报名信息提交</span>
            <a class="col-3 text-right" href="{{ route('home') }}"><img class="rounded-circle" src="{{ auth()->user()->avatar }}" alt="avatar" width="22" height="22"></a>
        </div>
    </header>
@endsection

@section('content')
    <div class="py-4 bg-light text-center">
        <img src="{{ asset('m/img/step_1.png') }}" alt="step_1" width="285" height="64">
    </div>
    <div class="px-3 py-3 text-truncate">{{ $tuan->activity->title }}</div>
    <p class="font-weight-light px-3 py-2 bg-light">活动信息</p>
    <div class="container-fluid">
        <dl class="row small">
            <dt class="col-4">集合地</dt>
            <dd class="col-8">{{ $tuan->activity->cfd }}</dd>
            <dt class="col-4">目的地</dt>
            <dd class="col-8">{{ $tuan->activity->country->name }} {{ $tuan->activity->province->name }} {{ $tuan->activity->city->name ?? '' }}  {{ $tuan->activity->district->name ?? '' }}</dd>
            <dt class="col-4">开始时间</dt>
            <dd class="col-8">{{ $tuan->activity->created_at->toDateString() }}</dd>
            <dt class="col-4">活动批次</dt>
            <dd class="col-8">{{ $tuan->start_time->toDateString() }} — {{ $tuan->end_time->toDateString() }}</dd>
            <dt class="col-4">活动天数</dt>
            <dd class="col-8">{{ $tuan->activity->trips()->count() }}天</dd>
            <dt class="col-4">活动费用</dt>
            <dd class="col-8 text-danger">¥{{ $tuan->price }}/人</dd>
        </dl>
    </div>
    <p class="font-weight-light px-3 py-2 bg-light">报名人信息</p>
    <div id="app">
        @verbatim
            <el-form class="order-form" label-position="top" :model="order" ref="order" v-loading="seed" element-loading-text="正在提交订单……">
                <div class="position-relative num-info pt-5 pb-3" v-for="(user, index) in order.users">
                    <div class="d-flex justify-content-between position-absolute">
                        <span class="text-white num">第{{ index + 1 }}个报名人</span>
                        <span class="close p-2" v-if="index > 0" @click="removeUser(index)">&times;</span>
                    </div>
                    <div class="px-4">
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
                </div>

                <el-form-item class="px-4">
                    <el-button type="warning" @click="addUser">新增报名人员</el-button>
                </el-form-item>

                <p class="font-weight-light px-3 py-2 bg-light">订单备注</p>
                <el-form-item class="px-4">
                    <el-input type="textarea" v-model="order.remarks" placeholder="最多可输入50个字"></el-input>
                </el-form-item>

                <p class="font-weight-light px-3 py-2 bg-light">支付金额</p>
                <p class="px-3 small">
                    <span class="text-muted">共 {{ order.users.length }}人，总金额：</span>
                    <span class="text-danger">{{ order.users.length }} x {{ price }} = ￥{{ (order.users.length * price).toFixed(2) }}元</span>
                </p>

                <div class="font-weight-light px-3 py-2 bg-light">支付方式</div>
                <ul class="list-group mb-4">
                    <li class="list-group-item border-left-0 border-right-0 rounded-0 d-flex justify-content-between align-items-center" @click.stop="changePay('alipay')">
                        <div class="w-75">
                            <img class="float-left m-1" src="/m/img/logo_alipay.png" alt="alipay" width="38" height="35">
                            <h6 class="mb-0">支付宝</h6>
                            <small>支付宝安全支付</small>
                        </div>
                        <el-radio v-model="order.type" label="alipay">&nbsp;</el-radio>
                    </li>
                    <li class="list-group-item border-left-0 border-right-0 rounded-0 d-flex justify-content-between align-items-center" @click.stop="changePay('wechat')">
                        <div class="w-75">
                            <img class="float-left m-1" src="/m/img/logo_wechat.png" alt="wechat" width="38" height="35">
                            <h6 class="mb-0">微信</h6>
                            <small>微信安全支付</small>
                        </div>
                        <el-radio v-model="order.type" label="wechat">&nbsp;</el-radio>
                    </li>
                </ul>

                <p class="px-4">
                    <button type="button" @click="submitForm" class="btn btn-danger btn-block">提交订单</button>
                </p>
            </el-form>
        @endverbatim
    </div>

@endsection

@section('footer', false)

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
                max: {{ $tuan->remainder() }},
                price: {{ $tuan->price }}
            }, methods: {
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
                            this.$notify.error({
                                title: '错误消息',
                                message: '报名信息没有填写完整。',
                            })
                            return false
                        }
                    })
                }
            }
        })
    </script>
@endpush