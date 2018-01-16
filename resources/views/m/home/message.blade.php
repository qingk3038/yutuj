@extends('layouts.m')

@section('title', '我的消息')

@section('header')
    @include('m.header', ['title' => '消息', 'theme' => 'white'])
@endsection

@section('content')
    @unless($messages->total())
        <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
            <div class="text-center">
                <img src="{{ asset('m/img/empty_order.png') }}" alt="empty message" width="140" height="90">
                <p class="d-block text-secondary">目前没有新消息!</p>
            </div>
        </div>
    @else
        <div class="container-fluid mt-5 py-3 small">
            @foreach($messages as $message)
                <div class="pl-5 position-relative" data-action="{{ route('user.message.read', $message) }}">
                    <img class="position-absolute" src="{{ asset(sprintf('img/icon_%s.png', $message->type)) }}" alt="{{ $message->type }}" style="left: 0; top: 0;">
                    @unless($message->read) <i class="unread"></i> @endunless
                    <h6 class="text-justify">{{ $message->title }}：</h6>
                    <div class="mb-2">{!! $message->body !!}</div>
                    <div class="d-flex justify-content-between text-secondary">
                        <span>{{ $message->created_at->diffForHumans() }}</span>
                        <a href="{{ route('user.message.destroy', $message) }}" class="text-muted btn-delete">删除</a>
                    </div>
                </div>
                @if($loop->remaining)
                    <hr>
                @endif
            @endforeach
        </div>
    @endunless
@endsection

@section('footer', false)

@push('script')
    <script>
        $('.btn-delete').click(function (event) {
            event.stopPropagation()
            let url = $(this).attr('href')
            let div = $(this).closest('div.position-relative')
            let hr = div.prev()
            axios.delete(url).then(res => {
                swal('操作已成功！', res.data.message, 'success')
                div.remove()
                hr.remove()
            }).catch(err => {
                let errors = err.response.data.errors;
                swal('失败啦！', Object.values(errors).join("\r\n"), 'error');
            })
            return false
        })

        $('.position-relative').click(function (event) {
            let url = $(this).data('action');
            let div = $(this).closest('div.position-relative')
            axios.put(url).then(res => {
                div.find('.unread').remove();
            })
        })
    </script>
@endpush