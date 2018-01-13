@extends('layouts.m')

@section('title', '我的游记')

@section('header')
    @include('m.header', ['title' => '游记详情', 'theme' => 'white'])
@endsection

@section('content')
    <div class="home-travels" style="margin-top: 2.7rem;">
        <div class="card">
            <div class="position-relative">
                <img class="card-img-top rounded-0" src="{{ imageCut(414, 220, $travel->thumb) }}" alt="{{ $travel->title }}" tid="{{ $travel->id }}">
                <div class="position-absolute up">
                    <small class="text-white">{{ $travel->likes()->count() }}</small>
                    <span class="fa-stack align-middle">
                    <i class="fa fa-circle fa-stack-2x text-primary"></i>
                    <i class="fa fa-thumbs-up fa-stack-1x fa-inverse"></i>
                </span>
                </div>
            </div>
            <div class="card-body py-2">
                <h6 class="card-title text-truncate">{{ $travel->title }}</h6>
                <p class="card-text mb-2 text-muted small d-flex justify-content-between">
                    <span class="mr-3"><i class="fa fa-fw fa-map-marker-alt"></i> 四川 成都</span>
                    <span class="mr-3"><i class="fa fa-fw fa-eye"></i> {{ $travel->click }}</span>
                    <span class="ml-auto"><i class="far fa-fw fa-clock"></i> {{ $travel->created_at->toDateString() }}</span>
                </p>
                <p class="card-text small d-flex justify-content-between">
                    <a href="{{ route('home.travel.edit', $travel) }}" class="text-secondary pr-2"><i class="fa fa-fw fa-edit text-info"></i>编辑</a>
                    <a href="javascript:void(0);" onclick="selectThumb({{ $travel->id }})" class="text-secondary pr-2"><i class="fa fa-fw fa-image text-info"></i>设置封面</a>
                    <a href="{{ route('home.travel.destroy', $travel) }}" class="text-secondary ml-auto btn-del"><i class="fa fa-fw fa-trash-alt text-danger"></i> 删除</a>
                </p>
            </div>
        </div>
    </div>
    <hr>
    <div class="div-body container-fluid text-justify small">
        {!! $travel->body !!}
    </div>

    <div class="d-flex justify-content-between p-3">
        @if($prevId)
            <a href="{{ route('home.travel.show', $prevId) }}" class="btn btn-sm btn-outline-warning"><i class="fa fa-fw fa-chevron-circle-left"></i>上一篇</a>
        @endif

        @if($nextId)
            <a href="{{ route('home.travel.show', $nextId) }}" class="btn btn-sm btn-outline-warning">下一篇<i class="fa fa-fw fa-chevron-circle-right"></i></a>
        @endif
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
                        setTimeout(function () {
                            history.back();
                        }, 2000)
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