@extends('layouts.m')

@section('title', ($user->name ?? $user->getHideMobile()) . '的游记列表')

@section('header')
    @include('m.header', ['title' => '游记列表'])
@endsection


@section('content')
    <img class="d-block w-100 mt-5" src="{{ imageCut(414, 220, $user->bg_home) }}" alt="主页背景">

    <div class="text-center">
        <p class="mb-0"><img src="{{ imageCut(110, 110, $user->avatar) }}" alt="头像" class="p-2 rounded-circle" style="background: rgba(255, 255, 255, .3); margin-top: -55px;"></p>
        <h5>HEHE <i class="fa fa-venus text-danger"></i></h5>
        <small>现居：{{ $user->province ?? '未知' }} {{ $user->city ?? '未知' }}</small>
        <p class="text-secondary">“{{ $user->description ?? '这家伙太懒了，还没有完善个人信息' }}”</p>
    </div>

    <ul class="nav bg-light" style="border-top: 1px solid #eeeeee; border-bottom: 1px solid #eeeeee;">
        <li class="nav-item px-3">
            <a class="nav-link px-0 text-dark" style="border-bottom: 2px solid #00a0e9; margin-bottom: -2px;">TA的游记</a>
        </li>
    </ul>
    <div class="home-travels py-3">
        @foreach($travels as $travel)
            <div class="card">
                <div class="position-relative mx-3">
                    <a href="{{ route('m.travel.show', $travel) }}">
                        <img class="card-img-top rounded-0" src="{{ imageCut(382, 160, $travel->thumb) }}" alt="{{ $travel->title }}" width="382" height="160">
                    </a>
                    <div class="position-absolute up">
                        <small class="text-white">{{ $travel->likes_count }}</small>
                        <span class="fa-stack align-middle btn-dz" data-tid="{{ $travel->id }}">
                            <i class="fa fa-circle fa-stack-2x text-primary"></i>
                            <i class="fa fa-thumbs-up fa-stack-1x fa-inverse"></i>
                        </span>
                    </div>
                </div>
                <div class="card-body py-2">
                    <h6 class="card-title text-truncate">
                        <a class="text-dark" href="{{ route('m.travel.show', $travel) }}">{{ $travel->title }}</a>
                    </h6>
                    <p class="card-text text-muted small d-flex justify-content-between">
                        @if($travel->province)
                            <span class="mr-3"><i class="fa fa-fw fa-map-marker-alt"></i> {{ $travel->province }} {{ $travel->city }}</span>
                        @endif
                        <span class="mr-3"><i class="fa fa-fw fa-eye"></i> {{ $travel->click }}</span>
                        <span class="ml-auto"><i class="far fa-fw fa-clock"></i> {{ $travel->created_at->toDateString() }}</span>
                    </p>
                </div>
            </div>
            @if($loop->remaining)
                <hr>
            @endif
        @endforeach
        <nav class="d-flex mt-4 justify-content-center">
            {{ $travels->links('vendor.pagination.m') }}
        </nav>
    </div>
@endsection


@push('script')
    <script>
        // 点赞
        $('.btn-dz').click(function () {
            let tid = $(this).data('tid')
            axios.post(`{{ url('travel/like') }}/${tid}`).then(res => {
                $(this).prev().text(res.data.likes_count)
            }).catch(err => {
                swal('失败啦！', err.response.data.message, 'error')
            })
        })
    </script>
@endpush