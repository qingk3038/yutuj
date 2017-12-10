@extends('layouts.app')

@section('title', '找回个人密码')
@section('header', false)
@section('footer', false)

@section('content')
    <div class="bg-forgot position-fixed">
        <div class="panel-login position-fixed">
            <p class="text-center"><img src="{{ asset('img/logo_login.png') }}" alt="logo_login"></p>
            <form class="position-relative" v-on:submit.prevent="onSubmit">
                <transition name="fade">
                    <div class="position-absolute text-danger error" v-if="error">
                        <i class="fa fa-info-circle"></i> @{{ errMsg }}
                    </div>
                </transition>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="请输入新密码" v-model="form.password">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="请输入重复密码" v-model="form.password_confirmation">
                </div>
                <button type="submit" class="btn btn-warning btn-block text-white">完成</button>
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