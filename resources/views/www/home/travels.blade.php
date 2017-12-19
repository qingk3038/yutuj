@extends('layouts.home')

@section('body')
    <div class="p-4">
        <h4>{{ $travel->title }}</h4>
        <div class="d-flex justify-content-between" style="font-size: 13px;">
            <span class="text-muted">
                @if($travel->province)<i class="fa fa-fw fa-map-marker"></i>{{ $travel->province }} {{ $travel->city }}@endif
                <i class="fa fa-fw fa-eye"></i>{{ $travel->click }}
                <i class="fa fa-fw fa-lg fa-clock-o"></i>{{ $travel->updated_at->toDateString() }}
            </span>
            <span class="btns">
                <a href="{{ route('travel.edit', $travel) }}">编辑</a>
                <a class="btn-del" href="javascript:void(0);" data-action="{{ route('travel.destroy', $travel) }}">删除</a>
            </span>
        </div>
        <hr>
        <div class="body">{!! $travel->body !!}</div>
        <p class="text-center mt-5">
            @if($prevId)
                <a href="{{ route('travel.show', $prevId) }}" class="btn btn-warning text-white px-3 mr-5">&lt;&lt;上一篇</a>
            @endif

            @if($nextId)
                <a href="{{ route('travel.show', $nextId) }}" class="btn btn-warning text-white px-3 mr-5">下一篇&gt;&gt;</a>
            @endif
        </p>
    </div>

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
    <script>
        $(document).ready(function () {
            // 删除
            $('.btn-del').click(function () {
                if (!confirm('确认要删除吗')) {
                    return
                }
                let url = $(this).data('action')
                axios.delete(url).then(res => {
                    alert(res.data.message)
                    history.back()
                })
            })
        })
    </script>
@endpush