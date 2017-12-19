@extends('layouts.app')

@section('title', $travel->title)

@section('content')
    <div class="bg-home text-hide" style="background-image: url({{ imageCut(1920, 500, $travel->user->bg_home) }});">封面</div>
    <div class="bg-white p-2" style="border-bottom: 2px solid #E5E5E5;">
        <div class="container text-muted">
            <a href="{{ route('www.user.travel', $travel->user) }}">
                <img class="rounded-circle align-bottom" src="{{ imageCut(120, 120, $travel->user->avatar) }}" alt="头像" width="120" height="120" style="margin-top: -80px;">
            </a>
            <a href="{{ route('www.user.travel', $travel->user) }}" class="pr-2 text-warning"><i class="fa fa-fw fa-lg {{ $travel->user->sex === 'F' ? 'text-primary fa-mercury' : 'text-danger fa-venus' }}"></i>{{ $travel->user->name }}</a>
            @if($travel->province)<span class="pr-2"><i class="fa fa-fw fa-map-marker"></i>{{ $travel->province }} {{ $travel->city }}</span>@endif
            <span class="pr-2"><i class="fa fa-fw fa-eye"></i>{{ $travel->click }}</span>
            <span class="pr-2"><i class="fa fa-fw fa-clock-o"></i>{{ $travel->created_at->toDateString() }}</span>
        </div>
    </div>


    <div class="container my-4">
        <div class="bg-white p-4">
            <h4>{{ $travel->title }}</h4>
            <div class="text-muted pt-2">
                <span>发布时间：{{ $travel->created_at }}</span>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-8">
                <div class="bg-white p-4 h-100">
                    <h5>为啥要带着孩子去旅行？</h5>
                    <br>
                    <p> 对于很多人而言，旅行无疑是件很美妙的事情。那有了孩子后，要不要带孩子去旅行呢?在回答这个问题之前，我们先来思考下，大部分人不愿意带娃出去旅游的原因。</p>
                    <br>1、孩子那么小，根本记不住。
                    <br>2、旅行中，小朋友不一定能适应，气候不一样，时差不一样，吃东西口味不一样，万一生病了，怎么办？还是在家安全。
                    <br>3、麻烦，带着小朋友，不能玩的尽兴。
                    <p>恩，就先从这些理由来看看吧。首先，记忆是个强化的过程，你可以帮她/他不断回忆出行经历，加强记忆会让她记</p>
                </div>
            </div>
            <div class="col-4 pl-0">
                <div class="bg-white mb-4 p-3">
                    <ul class="nav" role="tablist">
                        <li class="nav-item" style="margin-left: -15px;">
                            <a class="nav-link active" data-toggle="tab" href="#vp" role="tab">旅行短拍</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#zb" role="tab">大咖直播</a>
                        </li>
                    </ul>
                    <hr class="mt-2">
                    <div class="tab-content clearfix wan-video">
                        <div class="tab-pane fade show active" id="vp">
                            <div class="mb-4 position-relative">
                                <a href="#">
                                    <img src="{{ asset('uploads/d/list_2.jpg') }}" alt="list_2" class="img-fluid">
                                    <h5 class="position-absolute text text-truncate">世界很小，相遇在路上，泸沽湖纪念 旅途的点点滴滴</h5>
                                    <p class="position-absolute icon"><i class="fa fa-5x fa-play-circle-o"></i></p>
                                </a>
                            </div>
                            <a class="row text-right" href="#">
                                <span class="col-10">有361条旅行短拍</span>
                                <span class="col-2"><i class="fa fa-angle-right text-warning"></i></span>
                            </a>
                        </div>
                        <div class="tab-pane fade" id="zb">
                            <div class="mb-4 position-relative">
                                <a href="#">
                                    <img src="{{ asset('uploads/d/list_2.jpg') }}" alt="list_2" class="img-fluid">
                                    <h5 class="position-absolute text text-truncate">世界很大，相遇在路上，泸沽湖纪念 旅途的点点滴滴</h5>
                                    <p class="position-absolute icon"><i class="fa fa-5x fa-play-circle-o"></i></p>
                                </a>
                            </div>
                            <a class="row text-right" href="#">
                                <span class="col-10">有2361条旅行短拍</span>
                                <span class="col-2"><i class="fa fa-angle-right text-warning"></i></span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="bg-white mb-4 p-3">
                    <div class="text-warning">推荐活动</div>
                    <hr>

                    <a href="#"><img src="{{ asset('uploads/d/list_2.jpg') }}" alt="list_2" class="img-fluid"></a>
                    <p class="px-4 py-2">
                        <span class="float-right text-warning"><b>360</b>元起</span>
                        骨灰级成都吃货地图，天啊再也没有哪比成都的馆子多了
                    </p>


                    <a href="#"><img src="{{ asset('uploads/d/list_2.jpg') }}" alt="list_2" class="img-fluid"></a>
                    <p class="px-4 py-2">
                        <span class="float-right text-warning"><b>360</b>元起</span>
                        骨灰级成都吃货地图，天啊再也没有哪比成都的馆子多了
                    </p>

                    <a href="#"><img src="{{ asset('uploads/d/list_2.jpg') }}" alt="list_2" class="img-fluid"></a>
                    <p class="px-4 py-2">
                        <span class="float-right text-warning"><b>360</b>元起</span>
                        骨灰级成都吃货地图，天啊再也没有哪比成都的馆子多了
                    </p>

                    <a class="row text-right" href="#">
                        <span class="col-10">有2361条相关活动</span>
                        <span class="col-2"><i class="fa fa-angle-right text-warning"></i></span>
                    </a>
                </div>

                <div class="bg-white p-3">
                    <div class="text-warning">精彩游记</div>
                    <hr>

                    <a href="#"><img src="{{ asset('uploads/d/list_2.jpg') }}" alt="list_2" class="img-fluid"></a>
                    <p class="px-4 py-2">骨灰级成都吃货地图，天啊再也没有哪比成都的馆子多了，24小时都能满足你的胃</p>

                    <a href="#"><img src="{{ asset('uploads/d/list_2.jpg') }}" alt="list_2" class="img-fluid"></a>
                    <p class="px-4 py-2">骨灰级成都吃货地图，天啊再也没有哪比成都的馆子多了，24小时都能满足你的胃</p>

                    <a href="#"><img src="{{ asset('uploads/d/list_2.jpg') }}" alt="list_2" class="img-fluid"></a>
                    <p class="px-4 py-2">骨灰级成都吃货地图，天啊再也没有哪比成都的馆子多了，24小时都能满足你的胃</p>

                    <a class="row text-right" href="#">
                        <span class="col-10">有2361条相关游记</span>
                        <span class="col-2"><i class="fa fa-angle-right text-warning"></i></span>
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection