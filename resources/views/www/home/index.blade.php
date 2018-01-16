@extends('layouts.home')

@section('body')
    <div class="d-flex justify-content-between p-3">
        <span class="h5">我的游记</span>
        <a href="{{ route('home.travel.create') }}" class="btn btn-warning text-white px-3 py-1"><i class="fa fa-edit"></i> 发表游记</a>
    </div>
    @foreach($travels as $travel)
        <div class="card">
            <div class="position-relative">
                <img class="card-img-top" src="{{ imageCut(870, 290, $travel->thumb) }}" alt="{{ $travel->title }}" tid="{{ $travel->id }}" width="870" height="290">
                <div class="position-absolute p-3 btns d-flex">
                    <a href="javascript:void(0);" class="btn btn-dark border-0 mr-auto btn-del" data-action="{{ route('home.travel.destroy', $travel) }}"><i class="fa fa-trash-o"></i> 删除</a>
                    <a href="{{ route('home.travel.edit', $travel) }}" class="btn btn-dark border-0"><i class="fa fa-edit"></i> 编辑</a>
                    <a href="javascript:void(0);" onclick="selectThumb({{ $travel->id }})" class="btn btn-dark border-0 ml-2"><i class="fa fa-photo"></i> 设置封面</a>
                </div>
            </div>
            <div class="card-body position-relative">
                <div class="position-absolute up">
                    {{ $travel->likes_count }}
                    <span class="fa-stack fa-lg">
                        <i class="fa fa-circle fa-stack-2x text-info"></i>
                        <i class="fa fa-thumbs-o-up fa-stack-1x fa-inverse"></i>
                    </span>
                </div>
                <h5 class="card-title pr-5 mr-5">
                    <a href="{{ route('home.travel.show', $travel) }}">{{ $travel->title }}</a>
                </h5>
                <p class="text-muted">
                    @if($travel->province)<i class="fa fa-fw fa-map-marker"></i>{{ $travel->province }} {{ $travel->city }}@endif
                    <i class="fa fa-fw fa-eye"></i>{{ $travel->click }}
                    <i class="fa fa-fw fa-lg fa-clock-o"></i>{{ $travel->updated_at->diffForHumans() }}
                    @if($travel->status === 'audit')
                        <span class="text-info"><i class="fa fa-fw fa-lg fa-spinner fa-spin"></i>等待审核</span>
                    @elseif($travel->status==='adopt')
                        <span class="text-success"><i class="fa fa-fw fa-smile-o"></i>审核通过</span>
                    @elseif($travel->status==='reject')
                        <span class="text-danger"><i class="fa fa-fw fa-exclamation-circle"></i>审核拒绝</span>
                    @endif
                </p>
                <p class="card-text text-justify">{{ $travel->description }}</p>
            </div>
        </div>
    @endforeach

    @if($travels->total())
        <nav class="d-flex justify-content-center">
            {{ $travels->links() }}
        </nav>
    @else
        <div class="bg-light p-5 text-center"><img src="{{ asset('img/empty_release.png') }}" alt="empty_release" width="140" height="125"></div>
    @endif

    <input type="file" id="fileThumb" onchange="updateThumb(this)" hidden>
@endsection

@push('script')
    <link rel="stylesheet" href="{{ asset('/vendor/wangEditor-3.0.14/release/wangEditor.min.css') }}">
    <script src="{{ asset('/vendor/wangEditor-3.0.14/release/wangEditor.min.js') }}"></script>
    <script>
        let modal = $('#release')
        let msg = modal.find('.msg')
        let icon = modal.find('.icon > span')

        $(document).ready(function () {
            // 删除
            $('.btn-del').click(function () {
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
                        let url = $(this).data('action')
                        let div = $(this).closest('.card')
                        axios.delete(url).then(res => {
                            div.hide(300, () => {
                                $(this).remove();
                            })
                            swal('删除！', '你的一篇游记已经被删除。', 'success')
                        }).catch(err => {
                            swal('错误啦！', err.response.data.message, 'error')
                        })
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
                let errors = err.response.data.errors;
                swal('失败啦！', Object.values(errors).join("\r\n"), 'error');
            })
        }
    </script>
@endpush