@extends('layouts.home')

@section('body')
    <div class="d-flex justify-content-between p-3">
        <span class="h5">我的游记</span>
        <a href="{{ route('travel.create') }}" class="btn btn-warning text-white px-3 py-1"><i class="fa fa-edit"></i> 发表游记</a>
    </div>
    @foreach($travels as $travel)
        <div class="card">
            <div class="position-relative">
                <img class="card-img-top" src="{{ imageCut(870, 290, $travel->thumb) }}" alt="{{ $travel->title }}" tid="{{ $travel->id }}">
                <div class="position-absolute p-3 btns d-flex">
                    <a href="javascript:void(0);" class="btn btn-dark border-0 mr-auto btn-del" data-action="{{ route('travel.destroy', $travel) }}"><i class="fa fa-trash-o"></i> 删除</a>
                    <a href="{{ route('travel.edit', $travel) }}" class="btn btn-dark border-0"><i class="fa fa-edit"></i> 编辑</a>
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
                    <a href="{{ route('travel.show', $travel) }}">{{ $travel->title }}</a>
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

    <input type="file" id="fileThumb" onchange="updateThumb(this)" style="width: 0px; height: 0px; opacity: 0;">
    <div class="modal fade" id="release" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document" style="top: 30%;">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="close" data-dismiss="modal">&times;</span>
                    <div class="pt-4 pb-2 icon">
                        <span class="fa fa-fw fa-exclamation-circle fa-4x text-danger"></span>
                        <span class="fa fa-fw fa-smile-o fa-4x text-success"></span>
                    </div>
                    <p class="text-muted font-weight-light msg">未填写完成的消息提示</p>
                </div>
            </div>
        </div>
    </div>
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
                if (!confirm('确认要删除吗')) {
                    return
                }
                let url = $(this).data('action')
                let div = $(this).closest('.card')
                axios.delete(url).then(res => {
                    div.hide(300, () => {
                        $(this).remove()
                        msg.text('删除成功')
                        icon.eq(1).show()
                        icon.eq(0).hide()
                        modal.modal('show')
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
                msg.text(res.data.message)
                icon.eq(1).show()
                icon.eq(0).hide()
                return modal.modal('show')
            }).catch(err => {
                msg.html(err.response.data.message)
                icon.eq(0).show()
                icon.eq(1).hide()
                return modal.modal('show')
            })
        }
    </script>
@endpush