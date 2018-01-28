@extends('layouts.app')

@section('title', '用户注册')
@section('header', false)
@section('footer', false)

@section('content')
    <div class="bg-register position-fixed" id="app">
        <div class="panel-login position-fixed">
            <p class="text-center"><img src="{{ asset('img/logo_login.png') }}" alt="logo_login"></p>
            <form class="position-relative" v-on:submit.prevent="onSubmit">
                <transition name="fade">
                    <div class="position-absolute text-danger error" v-if="error">
                        <i class="fa fa-info-circle"></i> @{{ errMsg }}
                    </div>
                </transition>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="请输入手机号" v-model="form.mobile">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="请输入密码" v-model="form.password">
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="请输入验证码" v-model="form.code">
                        <div class="input-group-append">
                            <span class="input-group-text" style="font-size: 13px; cursor: pointer;" @click="getCode" v-if="seconds === 0">获取验证码</span>
                            <span class="input-group-text" style="font-size: 13px; cursor: pointer;" v-else>@{{ seconds }}s 后重新获取</span>
                        </div>
                    </div>
                </div>
                <p class="form-group">
                    <span class="text-secondary">注册视为同意</span><span class="text-warning">《遇途记用户使用协议》</span>
                </p>
                <div class="form-group">
                    <button type="submit" class="btn btn-warning btn-block text-white">注册</button>
                </div>
                <p class="clearfix mb-0">
                    <span class="float-right">已有账号？<a href="{{ asset('login') }}" class="text-warning">点击登录>></a></span>
                </p>
            </form>
        </div>
    </div>
@endsection

@push('script')
    <script>
        new Vue({
            el: '#app',
            data: {
                error: false,
                errMsg: '',
                form: {
                    mobile: '',
                    password: '',
                    code: ''
                },
                seconds: 0
            },
            methods: {
                onSubmit() {
                    if (this.checkTel() && this.checkPwd() && this.checkCode()) {
                        this.resetError()
                        axios.post("{{ route('register') }}", this.form).then(res => {
                            alert('恭喜,注册成功。')
                            location.href = res.data.url
                        }).catch(err => {
                            let errors = err.response.data.errors;
                            this.error = true
                            this.errMsg = Object.values(errors).join("\r\n")
                        })
                    }
                },
                resetError() {
                    this.error = false
                    this.errMsg = ''
                },
                checkTel() {
                    if (this.form.mobile.length === 0) {
                        this.error = true
                        this.errMsg = '请输入手机号码。'
                        return false
                    }
                    let reg = /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/;
                    if (!reg.test(this.form.mobile)) {
                        this.error = true
                        this.errMsg = '请输入有效的手机号码。'
                        return false;
                    }
                    return true
                },
                checkPwd() {
                    if (this.form.password.length === 0) {
                        this.error = true
                        this.errMsg = '请输入密码。'
                        return false
                    }
                    if (this.form.password.length < 6) {
                        this.error = true
                        this.errMsg = '请输入至少6位密码'
                        return false
                    }
                    return true
                },
                checkCode() {
                    if (this.form.code.length === 0) {
                        this.error = true
                        this.errMsg = '请输入验证码。'
                        return false
                    }
                    if (this.form.code.length < 4) {
                        this.error = true
                        this.errMsg = '请输入至少4位验证码。'
                        return false
                    }
                    return true
                },
                timer() {
                    this.seconds = 60
                    let interval = setInterval(() => {
                        this.seconds === 0 ? clearInterval(interval) : this.seconds--
                    }, 1000)
                },
                getCode() {
                    if (this.checkTel() && this.seconds === 0) {
                        this.resetError()
                        axios.post("{{ url('sms/register') }}", {mobile: this.form.mobile}).then(res => {
                            this.timer()
                            swal('短信已经发送', res.data.message)
                        }).catch(err => {
                            let errors = err.response.data.errors;
                            this.error = true
                            this.errMsg = Object.values(errors).join("\r\n")
                        })
                    }
                }
            }
        })
    </script>
@endpush