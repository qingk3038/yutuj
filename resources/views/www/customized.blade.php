@extends('layouts.app')

@section('title','简单三步，免费定制')

@section('content')
    <div class="bg-dz d-flex justify-content-center">
        <div class="iphone">
            <form autocomplete="off">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon bg-white"><i class="fa fa-fw fa-map-marker"></i></span>
                        <input type="text" class="form-control" name="title" placeholder="请填写您想去的目的地" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon bg-white"><i class="fa fa-fw fa-mobile"></i></span>
                        <input type="text" class="form-control" name="mobile" placeholder="请填写您的手机号码" required>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-warning text-white">开启定制行程</button>
                </div>
                <div class="form-group text-center text-white">
                    <p><img class="p-2 bg-white" src="{{ asset('img/weixin.jpg') }}" alt="weixin"></p>
                    <small>扫描二维码直接和顾问微信沟通</small>
                </div>
            </form>
        </div>
        <div class="pt-5 pl-5">
            <img src="{{ asset('img/bg_dz_step.png') }}" alt="bg_dz_step">
        </div>
    </div>
@endsection

@section('footer', false)

@push('script')
    <script>
        (function ($) {
            $(document).ready(setBgHieght);
            $(window).resize(setBgHieght);

            function setBgHieght() {
                let hbg = $(window).height() - $('header').height()
                $('.bg-dz').css('min-height', hbg);
            }

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
        })(jQuery)
    </script>
@endpush