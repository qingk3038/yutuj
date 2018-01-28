@extends('layouts.m')

@section('title','简单三步，免费定制')

@section('header')
    <header class="position-sticky text-warning">
        <span class="float-left" onclick="history.back();"><i class="fas fa-lg fa-angle-left"></i></span>
        <div class="text-center">专属定制</div>
    </header>
    <img class="w-100 d-block" src="{{ asset('m/img/customized_banner.jpg') }}" alt="customized_banner">
    <p class="container-fluid">
        <img class="w-100 d-block" src="{{ asset('m/img/customized_step.jpg') }}" alt="customized_step">
    </p>
    <form class="container-fluid" autocomplete="off">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-append">
                    <span class="input-group-text bg-white"><i class="fa fa-map-marker-alt"></i></span>
                </div>
                <input type="text" class="form-control border-left-0" name="title" placeholder="请填写您想去的目的地" required>
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-append">
                    <span class="input-group-text bg-white"><i class="fa fa-mobile-alt"></i></span>
                </div>
                <input type="text" class="form-control border-left-0" name="mobile" placeholder="请填写您的手机号码" required>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-warning btn-block">开始定制</button>
        </div>
    </form>
@endsection

@section('footer', false)

@push('script')
    <script>
        // 提交数据
        $('form').submit(function (event) {
            event.preventDefault()
            let param = $(this).serialize()
            axios.post("{{ url('customized') }}", param).then(res => {
                swal(res.data.title, res.data.message, 'success')
            }).catch(err => {
                swal(err.response.data.title, err.response.data.message, 'error')
            })
        })
    </script>
@endpush