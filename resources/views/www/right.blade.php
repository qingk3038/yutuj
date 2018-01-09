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
            @isset($film)
                <div class="mb-4 position-relative">
                    <a href="{{ route('www.video.show', $film) }}" title="{{ $film->title }}" target="_blank">
                        <img src="{{ imageCut(363, 245, $film->thumb) }}" alt="{{ $film->title }}" class="img-fluid">
                        <h5 class="position-absolute text text-truncate">{{ $film->title }}</h5>
                        <p class="position-absolute icon"><i class="fa fa-5x fa-play-circle-o"></i></p>
                    </a>
                </div>
            @endisset

            <a class="row text-right" href="{{ route('www.video.list') }}" target="_blank">
                <span class="col-10 font-weight-light">有<strong style="font-size: 26px;">{{ $film_count }}</strong>条旅行短拍</span>
                <span class="col-2 pt-2"><i class="fa fa-angle-right text-warning"></i></span>
            </a>
        </div>
        <div class="tab-pane fade" id="zb">
            @isset($live)
                <div class="mb-4 position-relative">
                    <a href="{{ route('www.video.show', $live) }}" title="{{ $live->title }}" target="_blank">
                        <img src="{{ imageCut(363, 245, $live->thumb) }}" alt="{{ $live->title }}" class="img-fluid">
                        <h5 class="position-absolute text text-truncate">{{ $live->title }}</h5>
                        <p class="position-absolute icon"><i class="fa fa-5x fa-play-circle-o"></i></p>
                    </a>
                </div>
            @endisset

            <a class="row text-right" href="{{ route('www.video.list') }}" target="_blank">
                <span class="col-10 font-weight-light">有<strong style="font-size: 26px;">{{ $live_count }}</strong>条大咖直播</span>
                <span class="col-2 pt-2"><i class="fa fa-angle-right text-warning"></i></span>
            </a>
        </div>
    </div>
</div>

@isset($province_rel)
    @php
        // 推荐活动
        $tops = Cache::remember('tops' . request()->fullUrl(), 5, function () use ($province_rel) {
            $arr['activities'] = $province_rel->provinceActivities()->active()->limit(3)->get(['id', 'title', 'thumb', 'description', 'price']);
            $arr['activities_count'] = $province_rel->provinceActivities()->active()->count();
            return $arr;
        });
    @endphp

    @if(count($tops['activities']))
        <div class="bg-white mb-4 p-3">
            <div class="text-warning">推荐活动</div>
            <hr>
            @foreach($tops['activities'] as $activity)
                <a href="{{ route('www.activity.show', $activity) }}" title="{{ $activity->title }}" target="_blank">
                    <img src="{{ imageCut(363, 200, $activity->thumb) }}" alt="{{ $activity->title }}" class="img-fluid">
                </a>
                <p class="px-4 py-2">
                    <span class="float-right text-warning  font-weight-light pl-3"><strong style="font-size: 26px;">{{ $activity->price }}</strong>元起</span>
                    {{ str_limit($activity->description, 50) }}
                </p>
            @endforeach
            <a class="row text-right" href="{{ route('www.activity.list', ['pid' => $province_rel->id]) }}" target="_blank">
                <span class="col-10 font-weight-light">有<strong style="font-size: 26px;">{{ $tops['activities_count'] }}</strong>条相关活动</span>
                <span class="col-2"><i class="fa fa-angle-right text-warning"></i></span>
            </a>
        </div>
    @endif
@else
    <div class="bg-white mb-4 p-3">
        <div class="text-warning">推荐攻略</div>
        <hr>
        @foreach($raiders as $raider)
            <a href="{{ route('www.raider.show', $raider) }}" title="{{ $raider->title }}" target="_blank">
                <img src="{{ imageCut(363, 200, $raider->thumb) }}" alt="{{ $raider->title }}" class="img-fluid">
            </a>
            <p class="px-4 py-2">{{ str_limit($raider->description, 70) }}</p>
        @endforeach
        <a class="row text-right" href="{{ route('www.raider.list') }}" target="_blank">
            <span class="col-10 font-weight-light">有<strong style="font-size: 26px;">{{ $raiders_count }}</strong>条相关攻略</span>
            <span class="col-2 pt-2"><i class="fa fa-angle-right text-warning"></i></span>
        </a>
    </div>
@endisset

<div class="bg-white p-3">
    <div class="text-warning">精彩游记</div>
    <hr>
    @foreach($travels as $travel)
        <a href="{{ route('www.travel.show', $travel) }}" title="{{ $travel->title }}" target="_blank">
            <img src="{{ imageCut(363, 200, $travel->thumb) }}" alt="{{ $travel->title }}" class="img-fluid">
        </a>
        <p class="px-4 py-2">{{ str_limit($travel->description, 70) }}</p>
    @endforeach

    <a class="row text-right" href="{{ route('www.travel.list') }}" target="_blank">
        <span class="col-10 font-weight-light">有<strong style="font-size: 26px;">{{ $travels_count }}</strong>条相关游记</span>
        <span class="col-2 pt-2"><i class="fa fa-angle-right text-warning"></i></span>
    </a>
</div>

