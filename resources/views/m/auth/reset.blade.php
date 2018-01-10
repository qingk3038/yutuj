@extends('layouts.m')

@section('title', '找回个人密码')

@section('header')
    <header class="position-sticky text-warning">
        <span class="float-left" onclick="history.back();"><i class="fas fa-lg fa-angle-left"></i></span>
        <div class="text-center">密码重置</div>
    </header>
@endsection

@section('content')
    <div class="container-fluid" id="app">
        <div class="text-center p-5">
            <img src="{{ asset('m/img/logo.png') }}" alt="logo" width="206" height="79">
        </div>

        <form v-on:submit.prevent="onSubmit">
            <div class="form-group">
                <input type="password" class="form-control" placeholder="设置密码：6-12位数字或字母密码" v-model="form.password">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="重复密码：6-12位数字或字母密码" v-model="form.password_confirmation">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-block btn-warning">确 &nbsp; 定</button>
            </div>
            <div class="form-group pb-2" v-if="error">
                <span class="text-danger"><i class="fa fa-fw fa-info-circle"></i> @{{ errMsg }}</span>
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
                    token: '{{ $token }}',
                    password: '',
                    password_confirmation: ''
                }
            },
            methods: {
                onSubmit() {
                    if (this.checkPwd()) {
                        this.resetError()
                        axios.post("{{ url('password/reset') }}", this.form).then(res => {
                            location.href = res.data.url
                        }).catch(err => {
                            this.error = true
                            this.errMsg = err.response.data.message
                        })
                    }
                },
                resetError() {
                    this.error = false
                    this.errMsg = ''
                },
                checkPwd() {
                    if (this.form.password.length === 0) {
                        this.error = true
                        this.errMsg = '请输入新密码。'
                        return false
                    }
                    if (this.form.password.length < 6) {
                        this.error = true
                        this.errMsg = '新密码长度至少6位。'
                        return false
                    }
                    if (this.form.password !== this.form.password_confirmation) {
                        this.error = true
                        this.errMsg = '2次输入密码不一致。'
                        return false
                    }
                    return true
                }
            }
        })
    </script>
@endpush