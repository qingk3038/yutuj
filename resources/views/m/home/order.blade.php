@extends('layouts.m')

@section('title', '我的订单')

@section('header')
    @include('m.header', ['title' => '我的订单'])
@endsection

@section('content')

    <!--
空订单
<div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="text-center">
        <img src="../img/empty_order.png" alt="empty_travel" width="140" height="90">
        <p class="d-block text-secondary">目前没有新订单!</p>
    </div>
</div>-->

    <div class="pt-5">
        <ul class="nav-justified nav nav-two bg-light text-nowrap">
            <li class="nav-item">
                <a class="nav-link active" href="#">全部</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">待付款</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">待出行</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">退款</a>
            </li>
        </ul>
    </div>

    <table class="table small">
        <tr>
            <td width="60">
                <a href="#"><img src="holder.js/60x60" alt=""></a>
            </td>
            <td class="text-secondary px-0">
                <a href="#" class=" d-block mb-1 text-dark">【朝圣世界之巅】尼泊尔 珠穆朗玛珠穆朗玛珠穆朗玛</a>
                订单号：2995107422 <br>
                数量：1 &nbsp; 总价：￥264 <br>
                2017-11-11
            </td>
            <td class="text-center text-secondary">
                <p class="text-danger mb-1">未支付</p>
                <a href="#" class="btn btn-sm btn-outline-warning">去支付</a>
            </td>
        </tr>
        <tr>
            <td width="60">
                <a href="#"><img src="holder.js/60x60" alt=""></a>
            </td>
            <td class="text-secondary px-0">
                <a href="#" class=" d-block mb-1 text-dark">【朝圣世界之巅】尼泊尔 珠穆朗玛珠穆朗玛珠穆朗玛</a>
                订单号：2995107422 <br>
                数量：1 &nbsp; 总价：￥264 <br>
                2017-11-11
            </td>
            <td class="text-center text-secondary">
                已出行
            </td>
        </tr>
        <tr>
            <td width="60">
                <a href="#"><img src="holder.js/60x60" alt=""></a>
            </td>
            <td class="text-secondary px-0">
                <a href="#" class=" d-block mb-1 text-dark">【朝圣世界之巅】尼泊尔 珠穆朗玛珠穆朗玛珠穆朗玛</a>
                订单号：2995107422 <br>
                数量：1 &nbsp; 总价：￥264 <br>
                2017-11-11
            </td>
            <td class="text-center text-secondary">
                已付款
            </td>
        </tr>
        <tr>
            <td width="60">
                <a href="#"><img src="holder.js/60x60" alt=""></a>
            </td>
            <td class="text-secondary px-0">
                <a href="#" class=" d-block mb-1 text-dark">【朝圣世界之巅】尼泊尔 珠穆朗玛珠穆朗玛珠穆朗玛</a>
                订单号：2995107422 <br>
                数量：1 &nbsp; 总价：￥264 <br>
                2017-11-11
            </td>
            <td class="text-center text-secondary">
                退款
            </td>
        </tr>
    </table>
@endsection

@section('footer', false)
