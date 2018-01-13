@extends('layouts.m')

@section('title', '我的游记')

@section('header')
    @include('m.header', ['title' => '我的游记', 'theme' => 'white'])
@endsection

@section('content')
    <div class="pt-5">
        <ul class="nav-justified nav nav-two bg-light text-nowrap">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#adopt">已发表</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#draft">草稿箱</a>
            </li>
        </ul>
        <div class="tab-content py-3 home-travels">
            <div class="tab-pane fade show active" id="adopt">
                @forelse($releases as $release)
                    <div class="card">
                        <div class="position-relative mx-3">
                            <a href="{{ route('home.travel.show', $release) }}">
                                <img class="card-img-top rounded-0" src="{{ imageCut(414, 220, $release->thumb) }}" alt="{{ $release->title }}" tid="{{ $release->id }}">
                            </a>
                            <div class="position-absolute up">
                                <small class="text-white">{{ $release->likes_count }}</small>
                                <span class="fa-stack align-middle">
                                    <i class="fa fa-circle fa-stack-2x text-primary"></i>
                                    <i class="fa fa-thumbs-up fa-stack-1x fa-inverse"></i>
                                </span>
                            </div>
                        </div>
                        <div class="card-body py-2">
                            <h6 class="card-title text-truncate">
                                <a class="text-dark" href="{{ route('home.travel.show', $release) }}">{{ $release->title }}</a>
                            </h6>
                            <p class="card-text mb-2 text-muted small d-flex justify-content-between">
                                @isset($release->province)
                                    <span class="mr-3"><i class="fa fa-fw fa-map-marker-alt"></i> {{ $release->province }} {{ $release->city }}</span>
                                @endisset
                                <span class="mr-3"><i class="fa fa-fw fa-eye"></i> {{ $release->click }}</span>
                                <span class="ml-auto"><i class="far fa-fw fa-clock"></i> {{ $release->updated_at->diffForHumans() }}</span>
                            </p>
                            <p class="card-text small d-flex justify-content-between">
                                <a href="{{ route('home.travel.edit', $release) }}" class="text-secondary pr-2"><i class="fa fa-fw fa-edit text-info"></i>编辑</a>
                                <a href="javascript:void(0);" onclick="selectThumb({{ $release->id }})" class="text-secondary pr-2"><i class="fa fa-fw fa-image text-info"></i>设置封面</a>

                                @if($release->status === 'audit')
                                    <span class="text-info"><i class="fa fa-fw fa-lg fa-spinner fa-spin"></i>等待审核</span>
                                @elseif($release->status==='adopt')
                                    <span class="text-success"><i class="far fa-fw fa-smile"></i>审核通过</span>
                                @elseif($release->status==='reject')
                                    <span class="text-danger"><i class="fa fa-fw fa-exclamation-circle"></i>审核拒绝</span>
                                @endif

                                <a href="{{ route('home.travel.destroy', $release) }}" class="text-secondary ml-auto btn-del"><i class="fa fa-fw fa-trash-alt text-danger"></i> 删除</a>
                            </p>
                        </div>
                        @if($loop->remaining)
                            <hr>
                        @endif
                    </div>
                @empty
                    <div class="d-flex py-5 justify-content-center align-items-center">
                        <div class="text-center text-secondary">
                            <img src="{{ asset('m/img/empty_travel.png') }}" alt="empty_travel" width="140" height="90">
                            <p>你还没发表过游记!</p>
                        </div>
                    </div>
                @endforelse
                <nav class="d-flex justify-content-center">
                    {{ $releases->links('vendor.pagination.m') }}
                </nav>
            </div>
            <div class="tab-pane fade" id="draft">
                @forelse($drafts as $draft)
                    <div class="card">
                        <div class="card-body py-2">
                            <h6 class="card-title text-truncate">
                                <a class="text-dark" href="{{ route('home.travel.edit', $draft) }}">{{ $draft->title }}</a>
                            </h6>
                            <p class="card-text small d-flex justify-content-between">
                                <span class="text-secondary">更新时间：{{ $draft->updated_at->diffForHumans() }}</span>
                                <a href="{{ route('home.travel.destroy', $draft) }}" class="text-secondary btn-del"><i class="fa fa-fw fa-trash-alt text-danger"></i> 删除</a>
                            </p>
                        </div>
                        <hr>
                    </div>
                @empty
                    <div class="d-flex py-5 justify-content-center align-items-center">
                        <div class="text-center text-secondary">
                            <img src="{{ asset('m/img/empty_travel.png') }}" alt="empty_travel" width="140" height="90">
                            <p>你的草稿箱为空!</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    <input type="file" id="fileThumb" onchange="updateThumb(this)" hidden>
@endsection

@push('script')
    <script>
        // 删除
        $('.btn-del').click(function (event) {
            event.preventDefault();

            swal({
                    title: '确定删除吗？',
                    text: '你将无法恢复该游记！',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#DD6B55',
                    confirmButtonText: '确定删除',
                    cancelButtonText: '取消删除',
                    closeOnConfirm: false
                },
                () => {
                    let url = $(this).attr('href')
                    let box = $(this).closest('.card')
                    axios.delete(url).then(res => {
                        box.hide(300, function () {
                            $(this).remove();
                        })
                        swal('删除！', '你的一篇游记已经被删除。', 'success')
                    }).catch(err => {
                        console.log(err)
                        let errors = err.response.data.errors;
                        swal('错误啦！', Object.values(errors).join("\r\n"), 'error')
                    })
                })
        })

        // 激活图片选择
        function selectThumb(id) {
            $('#fileThumb').data('tid', id).trigger('click')
        }

        // 设置封面
        function updateThumb(e) {
            let tid = $(e).data('tid')
            let param = new FormData();
            param.append('thumb', e.files[0])
            axios.post(`{{ url('home/travel/thumb') }}/${tid}`, param, {
                headers: {'Content-Type': 'multipart/form-data'}
            }).then(res => {
                $('img[tid="' + tid + '"]').prop('src', res.data.path)
                swal('操作已成功！', res.data.message, 'success')
            }).catch(err => {
                swal('失败啦！', err.response.data.message, 'error')
            })
        }
    </script>
@endpush