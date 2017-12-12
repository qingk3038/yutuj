@extends('layouts.home')

@section('body')
    <div class="d-flex justify-content-between p-3">
        <span class="h5">我的游记</span>
        <a href="{{ route('travel.create') }}" class="btn btn-warning text-white px-3 py-1"><i class="fa fa-edit"></i> 发表游记</a>
    </div>

    @foreach($travels as $travel)
        <div class="card">
            <div class="position-relative" style="height: 290px; background: url({{ Storage::url($travel->thumb) }}) center center / cover;">
                <div class="position-absolute p-3 btns d-flex">
                    <a href="javascript:void(0);" class="btn btn-dark border-0 mr-auto btn-del" data-action="{{ route('travel.destroy', $travel) }}"><i class="fa fa-trash-o"></i> 删除</a>
                    <a href="{{ route('travel.edit', $travel) }}" class="btn btn-dark border-0 mr-2"><i class="fa fa-edit"></i> 编辑</a>
                    @if($travel->status === 'adopt')
                        <a href="javascript:void(0);" class="btn btn-dark border-0"><i class="fa fa-photo"></i> 设置封面</a>
                    @endif
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
                    <i class="fa fa-fw fa-map-marker"></i> {{ $travel->city }}
                    <i class="fa fa-fw fa-eye"></i> {{ $travel->click }}
                    <i class="fa fa-fw fa-lg fa-clock-o"></i> {{ $travel->updated_at->diffForHumans() }}
                    @if($travel->status === 'audit')
                        <i class="fa fa-fw fa-lg fa-spinner fa-spin"></i> 等待审核
                    @elseif($travel->status==='reject')
                        <i class="fa fa-fw fa-lg fa-info-circle"></i> 审核拒绝
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

@endsection

@push('script')
    <link rel="stylesheet" href="{{ asset('/vendor/wangEditor-3.0.14/release/wangEditor.min.css') }}">
    <script src="{{ asset('/vendor/wangEditor-3.0.14/release/wangEditor.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            // 删除
            $('.btn-del').click(function () {
                if (!confirm('确认要删除吗')) {
                    return
                }
                let url = $(this).data('action')
                let div = $(this).closest('.card')
                axios.delete(url).then(res => {
                    div.remove()
                    alert(res.data.message)
                    location.reload()
                })
            })
        })
    </script>
@endpush