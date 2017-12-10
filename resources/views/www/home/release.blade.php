@extends('layouts.app')

@section('title', (auth()->user()->name ?? auth()->user()->mobile) . '的个人主页')

@section('content')
    <div class="container pt-4">
        <div class="bg-white home-release float-left">
            <h6 class="p-3" style="border-bottom: 1px solid #EEEEEE;">草稿箱（3）</h6>
            <ul class="list-unstyled px-3 clearfix">
                <li>
                <span class="float-left">
                    上海迪士尼乐园<br>
                    <small>2017-07-24</small>
                </span>
                    <span class="float-right">
                    <i class="fa fa-fw fa-lg fa-edit"></i>
                    <i class="fa fa-fw fa-lg fa-trash-o"></i>
                </span>
                </li>
                <li>
                <span class="float-left">
                    上海迪士尼乐园<br>
                    <small>2017-07-24</small>
                </span>
                    <span class="float-right">
                    <i class="fa fa-fw fa-lg fa-edit"></i>
                    <i class="fa fa-fw fa-lg fa-trash-o"></i>
                </span>
                </li>
                <li>
                <span class="float-left">
                    上海迪士尼乐园<br>
                    <small>2017-07-24</small>
                </span>
                    <span class="float-right">
                    <i class="fa fa-fw fa-lg fa-edit"></i>
                    <i class="fa fa-fw fa-lg fa-trash-o"></i>
                </span>
                </li>

            </ul>
        </div>
        <div class="bg-white home-travels float-right p-4">
            <form>
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="请在这里输入标题">
                </div>
                <div class="form-group">
                    <select class="custom-select mr-2" id="area">
                        <option>所在区域</option>
                        <option>四川</option>
                        <option>云南</option>
                        <option>青海</option>
                        <option>西藏</option>
                        <option>新疆</option>
                        <option>贵州</option>
                        <option>陕甘宁</option>
                        <option>内蒙古</option>
                        <option>广西</option>
                    </select>
                    <select class="custom-select" id="city">
                        <option>所在城市</option>
                        <option>成都</option>
                        <option>昆明</option>
                        <option>西安</option>
                        <option>拉萨</option>
                        <option>西宁</option>
                        <option>桂林</option>
                        <option>林芝</option>
                        <option>喀纳斯</option>
                        <option>大理</option>
                        <option>峨眉山</option>
                        <option>丽江</option>
                        <option>珠峰</option>
                    </select>
                </div>
                <div class="form-group icon-edit">
                    <span><i class="fa fa-photo text-info"></i> 图片</span>
                    <span><i class="fa fa-video-camera text-danger"></i> 视频</span>
                    <span><i class="fa fa-link text-success"></i> 链接</span>
                    <span><i class="fa fa-smile-o text-warning"></i> 表情</span>
                </div>
                <div class="form-group">
                    <textarea class="form-control" rows="10" placeholder="请在这里输入内容"></textarea>
                </div>
                <div class="form-group">
                    <label>
                        <input type="checkbox" checked>
                        我已阅读并同意<span class="text-warning">《遇途记游记协议》</span>
                    </label>
                </div>
                <div class="text-right">
                    <span class="btn btn-warning text-white px-4 py-1">确认发表</span>
                    <span class="btn btn-outline-warning px-4 py-1">保存草稿</span>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('script')
    <script>
        (function ($) {
            // 获取当前地理位置
            $.getScript('http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js', function () {
                $.each($('#area').find('option'), function (i, v) {
                    if (v.value === remote_ip_info.province) {
                        $('#area').val(remote_ip_info.province)
                        return false
                    }
                })
                $.each($('#city').find('option'), function (i, v) {
                    if (v.value === remote_ip_info.city) {
                        $('#city').val(remote_ip_info.city)
                        return false
                    }
                })
            })
        })(jQuery)
    </script>
@endpush