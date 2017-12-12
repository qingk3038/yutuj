@extends('layouts.home')

@section('body')
    <h5 class="px-3 pt-3 m-0">我的订单</h5>
    <!--<div class="bg-light p-5 mt-4 text-center"><img src="../img/empty_order.png" alt="empty_order" width="140" height="125"></div>-->
    <hr>
    <div class="px-4">
        <ul class="nav nav-pills nav-order">
            <li class="nav-item">
                <a class="nav-link active" href="#">全部</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">待支付</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">待出行</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="javascript:void(0);">取消/退款</a>
            </li>
        </ul>
        <table class="table list-order mt-3">
            <tr>
                <th class="text-center" colspan="2">订单信息</th>
                <th>数量</th>
                <th>总价</th>
                <th>订单状态</th>
                <th>订单号</th>
            </tr>
            <tr>
                <td><img src="{{ asset('uploads/d/thumb_huodong.jpg') }}" alt="thumb_huodong" width="82" height="51"></td>
                <td><a href="{{ route('home.order.info') }}" class="d-block">【朝圣世界之巅】尼泊尔珠穆朗玛 峰世界顶级纯玩圆梦…</a> 2017-07-12</td>
                <td>1</td>
                <td>￥264</td>
                <td>未支付 <a href="#" class="text-warning d-block">去支付</a></td>
                <td>2017225544877421</td>
            </tr>
            <tr>
                <td><img src="{{ asset('uploads/d/thumb_huodong.jpg') }}" alt="thumb_huodong" width="82" height="51"></td>
                <td><a href="{{ route('home.order.info') }}" class="d-block">【朝圣世界之巅】尼泊尔珠穆朗玛 峰世界顶级纯玩圆梦…</a> 2017-07-12</td>
                <td>1</td>
                <td>￥264</td>
                <td>已支付</td>
                <td>2017225544877421</td>
            </tr>
            <tr>
                <td><img src="{{ asset('uploads/d/thumb_huodong.jpg') }}" alt="thumb_huodong" width="82" height="51"></td>
                <td><a href="{{ route('home.order.info') }}" class="d-block">【朝圣世界之巅】尼泊尔珠穆朗玛 峰世界顶级纯玩圆梦…</a> 2017-07-12</td>
                <td>2</td>
                <td>￥364</td>
                <td>已出行</td>
                <td>2017225544877421</td>
            </tr>
        </table>
    </div>
    <nav class="px-3">
        <ul class="pagination justify-content-end">
            <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1">首页</a></li>
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">下一页</a></li>
        </ul>
    </nav>
@endsection