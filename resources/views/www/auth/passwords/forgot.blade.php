@extends('layouts.app')

@section('title', '找回个人密码')
@section('header', false)
@section('footer', false)

@section('content')
    <div class="bg-forgot position-fixed" id="app">
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
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="请输入验证码" v-model="form.code">
                        <div class="input-group-append">
                            <span class="input-group-text" style="font-size: 13px; cursor: pointer;" @click="getCode" v-if="seconds === 0">获取验证码</span>
                            <span class="input-group-text" style="font-size: 13px; cursor: pointer;" @click="getCode" v-else>@{{ seconds }}s 后重新获取</span>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-warning btn-block text-white">下一步</button>
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
                    code: ''
                },
                seconds: 0
            },
            methods: {
                onSubmit() {
                    if (this.checkTel() && this.checkCode()) {
                        this.resetError()
                        axios.post("{{ route('password.mobile') }}", this.form).then(res => {
                            location.href = "{{ url('password/reset') }}/" + res.data.token
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
                        this.errMsg = '请输入手机号码'
                        return false
                    }
                    let reg = /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/;
                    if (!reg.test(this.form.mobile)) {
                        this.error = true
                        this.errMsg = '请输入有效的手机号码'
                        return false;
                    }
                    return true
                },
                checkCode() {
                    if (this.form.code.length === 0) {
                        this.error = true
                        this.errMsg = '请输入验证码'
                        return false
                    }
                    if (this.form.code.length < 4) {
                        this.error = true
                        this.errMsg = '请输入至少4位验证码'
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
                        axios.post("{{ url('sms/forgot') }}", {mobile: this.form.mobile}).then(res => {
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
