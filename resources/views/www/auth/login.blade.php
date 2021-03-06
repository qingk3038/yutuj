@extends('layouts.app')

@section('title', '用户登录')
@section('header', false)
@section('footer', false)

@section('content')
    <div class="bg-login position-fixed" id="app">
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
                    <button type="submit" class="btn btn-warning btn-block text-white">登录</button>
                </div>
                <p class="clearfix">
                    <a href="{{ route('password.request') }}" class="float-left text-muted">忘记密码</a>
                    <span class="float-right">还没有账号？<a href="{{ asset('register') }}" class="text-warning">点击注册>></a></span>
                </p>
                <hr>
                <p class="text-muted mb-1">用第三方账户直接登录</p>
                <p class="mb-0 clearfix text-center text-muted">
                    <a href="{{ route('oauth.wechat') }}" class="float-left pr-2">
                        <span class="fa-stack fa-2x">
                            <i class="fa fa-circle fa-stack-2x text-warning"></i>
                            <i class="fa fa-wechat fa-stack-1x fa-inverse"></i>
                        </span>
                        <br>微信
                    </a>
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
                    password: ''
                },
                wp: window.opener
            },
            methods: {
                onSubmit() {
                    if (this.checkTel() && this.checkPwd()) {
                        this.resetError()
                        axios.post("{{ route('login') }}", this.form).then(res => {
                            if (this.wp) {
                                this.wp.authComplete()
                                window.close()
                            } else {
                                location.href = res.data.url
                            }
                        }).catch(err => {
                            if (err.response !== undefined) {
                                let errors = err.response.data.errors;
                                this.error = true
                                this.errMsg = Object.values(errors).join("\r\n")
                            } else {
                                location.reload()
                            }
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
                        return false
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
                        this.errMsg = '请输入至少6位密码。'
                        return false
                    }
                    return true
                }
            }
        })
    </script>
@endpush