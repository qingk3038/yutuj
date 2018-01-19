@extends('layouts.m')

@section('title', '我的设置')

@section('header', false)

@section('content')
    <header class="position-absolute bg-white container-fluid">
        <div class="text-warning row">
            <span class="col-3" onclick="history.back();"><i class="fas fa-lg fa-angle-left"></i></span>
            <span class="col text-center">头像</span>
            <span class="col-3 text-right"></span>
        </div>
    </header>
    <form class="mt-5 p-4" id="info">
        <p><img id="user_avatar" src="{{ auth()->user()->avatar }}" alt="user_avatar" class="img-fluid"></p>
        <span class="btn btn-warning text-white px-4 mr-2" onclick="javascript:$('#file_avatar').trigger('click');">选择图片</span> <br>
        <small class="text-muted">支持jpg、png、jpg，图片大小2MB以内</small>
        <input type="file" id="file_avatar" hidden onchange="uploadAvatar(event)" accept="image/*">
    </form>
@endsection

@section('footer', false)

@push('script')
    <script>
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
                location.href = document.referrer
            }).catch(err => {
                let errors = err.response.data.errors;
                swal('失败！', Object.values(errors).join("\r\n"), 'error')
            })
        }
    </script>
@endpush