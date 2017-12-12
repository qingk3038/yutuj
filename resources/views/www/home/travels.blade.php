@extends('layouts.home')

@section('body')
    <div class="p-4">
        <h4>{{ $travel->title }}</h4>
        <div class="d-flex justify-content-between" style="font-size: 13px;">
            <span class="text-muted">
                <i class="fa fa-fw fa-map-marker"></i> {{ $travel->city }}
                <i class="fa fa-fw fa-eye"></i> {{ $travel->click }}
                <i class="fa fa-fw fa-lg fa-clock-o"></i> {{ $travel->updated_at->toDateString() }}
            </span>
            <span class="btns">
                <a href="javascript:void(0);">设置封面</a>
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