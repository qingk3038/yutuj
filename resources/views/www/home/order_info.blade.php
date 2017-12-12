@extends('layouts.home')

@section('body')
    <h5 class="px-3 pt-3 m-0">订单详情</h5>
    <hr>
    <ul class="px-4 list-unstyled order-info">
        <li>
            <p>产品编号：YTJ66823</p>
            <h4>探索成都·微旅行 成都纯玩团一日游</h4>
        </li>
        <li>
            产品类型：自由行
            <br>游玩天数：3天
            <br>发团日期：每月多团
            <br>出发地点：成都
            <br>活动批次：2017-12-12 - 2017-12-15
        </li>
        <li>
            <h6>报名人1</h6>
            <div class="row">
                <div class="col-3">姓名：张三</div>
                <div class="col-3">证件类型：身份证</div>
                <div class="col-3 text-truncate">证件号：999999999999999999</div>
                <div class="col-3">联系电话：13684445999</div>
                <div class="col-3">紧急联系人：李四</div>
                <div class="col-3  text-truncate">紧急电话：1555555555523</div>
                <div class="col-3">备注：李四不来了</div>
            </div>
        </li>
        <li>
            <h6>报名人2</h6>
            <div class="row">
                <div class="col-3">姓名：张三</div>
                <div class="col-3">证件类型：身份证</div>
                <div class="col-3 text-truncate">证件号：999999999999999999</div>
                <div class="col-3">联系电话：13684445999</div>
                <div class="col-3">紧急联系人：李四</div>
                <div class="col-3  text-truncate">紧急电话：1555555555523</div>
                <div class="col-3">备注：李四不来了</div>
            </div>
        </li>
        <li>
            <h6>报名人3</h6>
            <div class="row">
                <div class="col-3">姓名：张三</div>
                <div class="col-3">证件类型：身份证</div>
                <div class="col-3 text-truncate">证件号：999999999999999999</div>
                <div class="col-3">联系电话：13684445999</div>
                <div class="col-3">紧急联系人：李四</div>
                <div class="col-3  text-truncate">紧急电话：1555555555523</div>
                <div class="col-3">备注：李四不来了</div>
            </div>
        </li>
        <li>
            总人数：3人
            <br>总金额：<span class="text-danger">¥2360元</span>
            <br>活动状态：未支付 <a href="#" class="text-warning text-white">去支付</a>
        </li>
    </ul>
@endsection