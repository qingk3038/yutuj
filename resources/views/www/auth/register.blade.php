@extends('layouts.app')

@section('header', false)
@section('footer', false)

@section('content')
    <div class="bg-register position-fixed">
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
                        <span class="input-group-addon" style="font-size: 13px; cursor: pointer;" @click="getCode">免费获取验证码</span>
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
                }
            },
            methods: {
                onSubmit() {
                    if (this.checkTel() && this.checkPwd() && this.checkCode()) {
                        this.resetError()
                        axios.post("{{ url('/register') }}", this.form).then(res => {
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
                getCode() {
                    if (this.checkTel()) {
                        this.resetError()
                        axios.post("{{ url('sms/register') }}", {mobile: this.form.mobile}).then(res => {
                            alert(res.data.message)
                        }).catch(err => {
                            alert(err.response.data.message)
                        })
                    }
                }
            }
        })
    </script>
@endpush