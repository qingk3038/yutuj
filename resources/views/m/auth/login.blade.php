@extends('layouts.m')

@section('title', '用户登录')

@section('header')
    <header class="position-sticky text-warning">
        <span class="float-left" onclick="history.back();"><i class="fas fa-lg fa-angle-left"></i></span>
        <div class="text-center">遇途记欢迎您</div>
    </header>
@endsection

@section('content')
    <div class="container-fluid" id="app">
        <div class="text-center p-5">
            <img src="{{ asset('m/img/logo.png') }}" alt="logo" width="206" height="79">
        </div>

        <form v-on:submit.prevent="onSubmit">
            <div class="form-group">
                <input type="tel" name="mobile" class="form-control" placeholder="请输入手机号" v-model="form.mobile">
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="请输入密码" v-model="form.password">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-block btn-warning">登 &nbsp; 陆</button>
            </div>
            <div class="form-group pb-2 clearfix">
                <span class="text-danger" v-if="error">
                    <i class="fa fa-fw fa-info-circle"></i>@{{ errMsg }}
                </span>
                <a href="{{ route('password.request') }}" class="float-right text-muted">忘记密码</a>
            </div>
        </form>

        <hr>
        <div class="text-center">
            <p class="text-muted" style="margin-top: -30px;">
                <span class="px-2 bg-white">其他方式登陆</span>
            </p>
            <p>
                <i class="fab fa-2x fa-qq text-info mr-3"></i>
                <i class="fab fa-2x fa-weixin text-success"></i>
            </p>
        </div>
        <p>
            <a href="{{ route('register') }}" class="btn btn-block btn-outline-warning">手机快速注册</a>
        </p>
    </div>
@endsection

@section('footer', false)

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
                },
            },
            methods: {
                onSubmit() {
                    if (this.checkTel() && this.checkPwd()) {
                        this.resetError()
                        axios.post("{{ route('login') }}", this.form).then(res => {
                            location.href = res.data.url
                        }).catch(err => {
                            if (err.response !== 'undefined') {
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