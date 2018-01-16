@extends('layouts.home')

@section('body')
    <h5 class="px-3 pt-3 m-0">我的消息</h5>
    @unless($messages->total())
        <div class="bg-light p-5 mt-4 text-center"><img src="{{ asset('img/empty_message.png') }}" alt="empty_message" width="140" height="125"></div>
    @else
        <hr>
        <div class="px-4">
            <table class="table list-message text-muted">
                @foreach($messages as $message)
                    <tr>
                        <td><input type="checkbox" value="{{ $message->id }}"></td>
                        <td>
                            <div class="position-relative">
                                <img src="{{ asset(sprintf('img/icon_%s.png', $message->type)) }}" alt="{{ $message->type }}" width="32" height="32">
                                @unless($message->read) <i class="position-absolute unread"></i> @endunless
                            </div>
                        </td>
                        <td>
                            <h6 class="text-dark">{{ $message->title }}：</h6>
                            {!! $message->body !!}
                        </td>
                        <td class="text-right text-nowrap">{{ $message->created_at->diffForHumans() }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="4">
                        <label class="mr-3">
                            <input type="checkbox" id="all"> 批量设置
                        </label>
                        <span class="btn btn-outline-secondary btn-sm" onclick="allSelectMessage()">全选</span>
                        <span class="btn btn-outline-secondary btn-sm" onclick="readSelectMessages()">已读</span>
                        <span class="btn btn-outline-secondary btn-sm" onclick="deleteSelectMessages()">删除</span>
                    </td>
                </tr>
            </table>
        </div>
        <nav class="d-flex justify-content-end px-3">
            {{ $messages->links() }}
        </nav>
    @endunless
@endsection

@push('script')
    <script>
        $('#all').click(function () {
            let c = $(this).prop('checked')
            $('.list-message :checkbox').prop('checked', c)
        })

        $('.list-message [type="checkbox"]').click(function () {
            let ins = $('.list-message input[type="checkbox"]').not('#all,input:checked')
            $('#all').prop('checked', !ins.length)
        })

        function allSelectMessage() {
            $('#all').trigger('click');
        }

        function deleteSelectMessages() {
            let ids = [];
            let inputs = $('.list-message input:checked').not('#all')
            inputs.each(function (i, v) {
                ids.push(v.value)
            })
            if (!ids.length) {
                return
            }
            axios.delete("{{ route('user.message.destroy') }}", {
                params: {ids}
            }).then(res => {
                inputs.closest('tr').remove();
                swal('操作已成功！', res.data.message, 'success')
            }).catch(err => {
                let errors = err.response.data.errors;
                swal('失败啦！', Object.values(errors).join("\r\n"), 'error');
            })
        }

        function readSelectMessages() {
            let ids = [];
            let inputs = $('.list-message input:checked').not('#all')
            inputs.each(function (i, v) {
                ids.push(v.value)
            })
            if (!ids.length) {
                return
            }
            axios.put("{{ route('user.message.read') }}", {ids}).then(res => {
                swal('操作已成功！', res.data.message, 'success')
                inputs.closest('tr').find('.unread').remove();
            }).catch(err => {
                let errors = err.response.data.errors;
                swal('失败啦！', Object.values(errors).join("\r\n"), 'error');
            })
        }
    </script>
@endpush