@extends('layouts.m')

@section('title', '我的设置')

@section('header', false)

@section('content')
    <header class="position-absolute bg-white container-fluid">
        <div class="text-warning row">
            <span class="col-3" onclick="history.back();"><i class="fas fa-lg fa-angle-left"></i></span>
            <span class="col text-center">居住城市</span>
            <span class="col-3 text-right do-complete">完成</span>
        </div>
    </header>
    <form class="container-fluid mt-5 pt-3" id="info">
        <div class="form-group">
            <label for="province">所在省份</label>
            <input type="text" class="form-control" placeholder="如：四川" id="province" name="province" value="{{ auth()->user()->province }}">
        </div>
        <div class="form-group position-relative">
            <label for="city">所在城市</label>
            <input type="text" class="form-control" placeholder="如：成都" id="city" name="city" value="{{ auth()->user()->city }}">
        </div>
    </form>
@endsection

@section('footer', false)

@push('script')
    <script>
        // 获取当前地理位置
        $.getScript('http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js', function () {
            if ($('#province').val() === '') {
                $('#province').val(remote_ip_info.province)
            }
            if ($('#city').val() === '') {
                $('#city').val(remote_ip_info.city)
            }
        })
    </script>
@endpush