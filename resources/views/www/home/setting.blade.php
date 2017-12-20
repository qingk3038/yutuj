@extends('layouts.home')

@section('title', (auth()->user()->name ?? auth()->user()->mobile) . '的主页')

@section('body')
    <div class="p-4">
        <ul class="nav nav-tabs mb-3" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#info">我的信息</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#avatar">我的头像</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#account">账号安全</a>
            </li>
        </ul>
        <div class="tab-content">
            <form class="tab-pane fade show active" id="info" novalidate>
                <div class="form-group row">
                    <label for="nickname" class="col-2 col-form-label">昵称：</label>
                    <div class="col-10">
                        <input type="text" class="form-control" id="nickname" name="name" placeholder="如：大虫子" required value="{{ auth()->user()->name }}">
                        <div class="invalid-feedback">
                            请输入 昵称
                        </div>
                    </div>
                </div>
                <fieldset class="form-group">
                    <div class="row">
                        <legend class="col-form-legend col-2 pt-0">性别</legend>
                        <div class="col-10">
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="sex" value="M" @if(auth()->user()->sex === 'M') checked @endif> 男性
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="sex" value="F" @if(auth()->user()->sex === 'F') checked @endif> 女性
                                </label>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <div class="form-group row">
                    <div class="col">
                        <div class="row">
                            <label for="province" class="col-4 col-form-label">居住省份：</label>
                            <div class="col-8">
                                <input type="text" class="form-control" id="province" name="province" placeholder="如：四川" required value="{{ auth()->user()->province }}">
                                <div class="invalid-feedback">请输入 居住省份</div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="row">
                            <label for="city" class="col-4 col-form-label text-right">居住城市：</label>
                            <div class="col-8">
                                <input type="text" class="form-control" id="city" name="city" placeholder="如：成都" required value="{{ auth()->user()->city }}">
                                <div class="invalid-feedback">请输入 居住城市</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="birthday" class="col-2 col-form-label">出生日期：</label>
                    <div class="col-10">
                        <input type="date" class="form-control" id="birthday" name="birthday" value="{{ auth()->user()->birthday }}" max="{{ \Carbon\Carbon::now()->toDateString() }}" min="{{ \Carbon\Carbon::now()->subYear(60)->toDateString() }}" required>
                        <div class="invalid-feedback">请选择 出生日期</div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="description" class="col-2 col-form-label">个人简介：</label>
                    <div class="col-10">
                        <textarea class="form-control" id="description" name="description" rows="5" placeholder="250字内，如：自2006年起爱上户外，此后一发不可收拾，旅行到全国各地的名山大川…" required>{{ auth()->user()->description }}</textarea>
                        <div class="invalid-feedback">请输入 个人简介</div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-2 offset-5">
                        <button type="submit" class="btn btn-block btn-warning text-white">保存</button>
                    </div>
                </div>
            </form>
            <div class="tab-pane fade" id="avatar" role="tabpanel">
                <p><img id="user_avatar" src="{{ auth()->user()->avatar }}" alt="user_avatar" width="120"></p>
                <span class="btn btn-warning text-white px-4 mr-2" onclick="javascript:$('#file_avatar').trigger('click');">选择图片</span>
                <span class="text-muted">支持jpg、png、jpeg、bmp，图片大小2MB以内</span>
                <input type="file" id="file_avatar" style="opacity: 0; width: 0px; height: 0px;" onchange="uploadAvatar(event)" accept="image/*">
            </div>
            <div class="tab-pane fade" id="account" role="tabpanel">
                <div class="form-group row">
                    <label for="birthday" class="col-2 col-form-label">密码：</label>
                    <div class="col-10">
                        <span class="btn btn-light" onclick="showMobileForm()">修改密码</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="birthday" class="col-2 col-form-label">绑定手机：</label>
                    <div class="col-10">
                        <span id="mobile_hide">156****1868</span>
                        <span class="btn btn-warning text-white ml-2" data-toggle="modal" data-target="#telUpdate">更改号码</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="pwdUpdate" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document" style="margin-top: 10rem">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="mobile">
                        <div class="form-group">
                            <input type="tel" id="tel" class="form-control" placeholder="输入手机号码">
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" id="code" class="form-control" placeholder="输入验证码">
                                <span class="input-group-addon" onclick="sendCode()" style="font-size: 12px; cursor: pointer;">免费获取验证码</span>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-warning btn-block text-white" onclick="showPwdForm()">下一步</button>
                    </div>
                    <form id="userPwd" class="pwd d-none">
                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="输入新密码">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password_confirmation" class="form-control" placeholder="重复密码">
                        </div>
                        <button type="submit" class="btn btn-warning btn-block text-white">完成</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <form class="modal fade" id="telUpdate" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document" style="margin-top: 10rem">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="mobile">
                        <div class="form-group">
                            <input type="tel" id="oldTel" name="oldTel" class="form-control" placeholder="验证原手机号">
                        </div>
                        <div class="form-group">
                            <input type="tel" id="newTel" name="newTel" class="form-control" placeholder="绑定新手机号">
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" id="code" name="code" class="form-control" placeholder="输入验证码">
                                <span class="input-group-addon" onclick="sendCodeTel()" style="font-size: 12px; cursor: pointer;">免费获取验证码</span>
                            </div>
                            <small class="form-text text-muted" style="font-size: 10px;"><i class="fa fa-fw fa-info-circle"></i>验证码发送至原手机号，无法获取请选择在线客服。</small>
                        </div>
                        <button type="submit" class="btn btn-warning btn-block text-white">完成</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('script')
    <script>
        (function ($) {
            // 获取当前城市
            $.getScript('http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js', function () {
                if ($('#province').val() === '') {
                    $('#province').val(remote_ip_info.province)
                }
                if ($('#city').val() === '') {
                    $('#city').val(remote_ip_info.city)
                }
            })

            // 个人信息
            $('#info').submit(function (event) {
                event.preventDefault()
                if (this.checkValidity() === false) {
                    event.stopPropagation()
                    $(this).addClass('was-validated')
                    return
                }

                let param = $(this).serialize();
                axios.put("{{ route('user.update') }}", param).then(res => {
                    swal('成功！', res.data.message, 'success')
                }).catch(err => {
                    let errors = err.response.data.errors;
                    swal('失败！', Object.values(errors).join("\r\n"), 'error')
                })
            })

            // 提交修改密码
            $('#userPwd').submit(function (event) {
                event.preventDefault()
                let param = $(this).serialize() + '&' + $.param({code: $('#code').val()});
                axios.put("{{ route('user.pwd') }}", param).then(res => {
                    $('#pwdUpdate').modal('hide')
                    swal('成功！', res.data.message, 'success')
                }).catch(err => {
                    if (err.response.data.errors.code !== 'undefined') {
                        showMobileForm()
                    }
                    let errors = err.response.data.errors
                    swal('失败！', Object.values(errors).join("\r\n"), 'error')
                })
            })


            // 更新手机号
            $('#telUpdate').submit(function (event) {
                event.preventDefault()
                let param = $(this).serialize()
                axios.put("{{ route('user.mobile') }}", param).then(res => {
                    $('#telUpdate').modal('hide')
                    swal('成功！', res.data.message, 'success')
                }).catch(err => {
                    let errors = err.response.data.errors;
                    swal('失败！', Object.values(errors).join("\r\n"), 'error')
                })
            })

        })(jQuery)

        // 显示更新手机号form
        function showMobileForm() {
            let d = $('#pwdUpdate')
            d.find('.mobile').removeClass('d-none')
            d.find('.pwd').addClass('d-none')
            d.modal('show')
        }

        // 显示更新密码form
        function showPwdForm() {
            if (!checkCode() || !checkTel()) {
                return
            }
            let d = $('#pwdUpdate')
            d.find('.mobile').addClass('d-none')
            d.find('.pwd').removeClass('d-none')
        }

        // 上传文件
        function uploadAvatar(e) {
            let file = e.target.files[0];

            if (file.size / 1024 / 1024 >= 1) {
                return alert('请上传小于1MB的图片。');
            }

            let param = new FormData();
            param.append('avatar', file)
            axios.post("{{ route('user.avatar') }}", param, {
                headers: {'Content-Type': 'multipart/form-data'}
            }).then(res => {
                document.getElementById('user_avatar').src = res.data.path + '?t=' + new Date().getTime()
                location.reload()
            }).catch(err => {
                let errors = err.response.data.errors;
                swal('失败！', Object.values(errors).join("\r\n"), 'error')
            })
        }

        /**
         * 检查手机号
         */
        function checkTel() {
            let mobile = $('#tel').val();
            if (mobile.length === 0) {
                swal('提示！', '请输入手机号码。', 'warning')
                return false
            }
            let reg = /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/;
            if (!reg.test(mobile)) {
                swal('提示！', '请输入有效的手机号码。', 'warning')
                return false
            }
            return true
        }

        /**
         * 检查验证码
         */
        function checkCode() {
            let code = $('#code').val();
            if (code.length === 0) {
                swal('提示！', '请输入验证码。', 'warning')
                return false
            }
            if (code.length < 4) {
                swal('提示！', '验证码至少4位。', 'warning')
                return false
            }
            return true
        }

        /**
         * 发送验证码
         */
        function sendCode() {
            if (!checkTel()) {
                return
            }
            axios.post("{{ url('sms/forgot') }}", {mobile: $('#tel').val()}).then(res => {
                swal('成功！', res.data.message, 'success')
            }).catch(err => {
                let errors = err.response.data.errors;
                swal('失败！', Object.values(errors).join("\r\n"), 'error')
            })
        }

        /**
         * 更改绑定手机
         * 发送旧手机号
         */
        function sendCodeTel() {
            let oldTel = $('#oldTel').val();
            if (oldTel === '') {
                swal('提示！', '请输入原手机。', 'warning')
                return
            }
            axios.post("{{ url('sms/update') }}", {mobile: oldTel}).then(res => {
                swal('成功！',res.data.message, 'warning')
            }).catch(err => {
                let errors = err.response.data.errors;
                swal('失败！', Object.values(errors).join("\r\n"), 'error')
            })
        }
    </script>
@endpush