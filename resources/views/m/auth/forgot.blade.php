@extends('layouts.m')

@section('title', '找回个人密码')

@section('header')
    <header class="position-sticky text-warning">
        <span class="float-left" onclick="history.back();"><i class="fas fa-lg fa-angle-left"></i></span>
        <div class="text-center">找回密码</div>
    </header>
@endsection

@section('content')
    <div class="container-fluid" id="app">
        <div class="text-center p-5">
            <img src="{{ asset('m/img/logo.png') }}" alt="logo" width="206" height="79">
        </div>

        <form v-on:submit.prevent="onSubmit">
            <div class="form-group">
                <input type="tel" class="form-control" placeholder="请输入手机号" v-model="form.mobile">
            </div>
            <div class="form-group position-relative">
                <input type="text" class="form-control" placeholder="请输入验证码" v-model="form.code">
                <span class="btn-sm btn-warning position-absolute px-3" style="right: 5px; top: 5px;" @click="getCode">获取验证码</span>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-block btn-warning">立即找回</button>
            </div>
            <div class="form-group pb-2" v-if="error">
                <span class="text-danger">
                    <i class="fa fa-fw fa-info-circle"></i> @{{ errMsg }}
                </span>
            </div>
        </form>
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
                    code: ''
                }
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
                getCode() {
                    if (this.checkTel()) {
                        this.resetError()
                        axios.post("{{ url('sms/forgot') }}", {mobile: this.form.mobile}).then(res => {
                            alert(res.data.message)
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
