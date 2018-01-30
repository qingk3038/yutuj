@extends('layouts.app')

@section('title', '编辑游记')

@section('content')
    <div class="container pt-4">
        <div class="bg-white home-release float-left">
            <h6 class="p-3" style="border-bottom: 1px solid #EEEEEE;">草稿箱（{{ auth()->user()->travels()->status('draft')->count() }}）</h6>
            <ul class="list-unstyled px-3 clearfix">
                @forelse(auth()->user()->travels()->status('draft')->get() as $travel)
                    <li>
                        <span class="float-left">
                             <a href="{{ route('home.travel.show', $travel) }}">{{ str_limit($travel->title, 30) }}</a><br>
                            <small>{{ $travel->updated_at }}</small>
                        </span>
                        <span class="float-right">
                            <a href="{{ route('home.travel.edit', $travel) }}" class="fa fa-fw fa-lg fa-edit"></a>
                            <a href="javascript:void(0);" class="fa fa-fw fa-lg fa-trash-o btn-del" data-action="{{ route('home.travel.destroy', $travel) }}"></a>
                        </span>
                    </li>
                @empty
                    <li>
                        <i class="fa fa-fw fa-info-circle"></i> 没有草稿记录
                    </li>
                @endforelse
            </ul>
        </div>
        <div class="bg-white home-travels float-right p-4">
            <form id="releaseForm">
                <input type="hidden" name="province" id="province" value="{{ $travel->province }}">
                <input type="hidden" name="city" id="city" value="{{ $travel->city }}">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="这里输入游记标题" name="title" value="{{ $travel->title }}">
                </div>
                <div class="form-group">
                    <p><img src="{{ imageCut(870, 290, $travel->thumb) }}" class="img-thumbnail showImage" alt="缩略图" width="870"></p>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="thumb" name="thumb">
                        <label class="custom-file-label text-truncate" for="thumb">选择游记封面</label>
                    </div>
                </div>
                <div class="form-group">
                    <textarea name="description" class="form-control text-muted" rows="3" placeholder="游记摘要也很重要…">{{ $travel->description }}</textarea>
                </div>
                <div class="form-group">
                    <div id="edit"></div>
                    <textarea name="body" hidden class="form-control" rows="10" placeholder="请在这里编辑游记内容">{{ $travel->body }}</textarea>
                </div>
                <div class="form-group">
                    <label>
                        <input type="checkbox" checked>
                        我已阅读并同意<span class="text-warning">《遇途记游记协议》</span>
                    </label>
                </div>
                <div class="text-right">
                    @if($travel->status === 'adopt')
                        <small class="px-2 text-success"><i class="fa fa-fw fa-smile-o"></i>审核通过</small>
                    @elseif($travel->status === 'reject')
                        <small class="px-2 text-danger"><i class="fa fa-fw fa-exclamation-circle"></i>审核拒绝</small>
                    @endif
                    <span class="btn btn-warning text-white px-4 py-1" onclick="release('audit')">确认发表</span>
                    <span class="btn btn-outline-warning px-4 py-1" onclick="release('draft')">保存草稿</span>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('script')
    <link rel="stylesheet" href="{{ asset('/vendor/wangEditor-3.0.14/release/wangEditor.min.css') }}">
    <script src="{{ asset('/vendor/wangEditor-3.0.14/release/wangEditor.min.js') }}"></script>
    <script>
        let editor = new wangEditor('#edit')
        $(document).ready(function () {
            initEdit();

            // 刷新默认显示缩略图
            $('#thumb').change(function () {
                let src = window.URL.createObjectURL(this.files[0])
                $('.showImage').prop('src', src).removeClass('d-none')
                $(this).next().text($(this).val())
            })
            if ($('#thumb').val() !== '') {
                $('#thumb').trigger('change')
            }

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
                        let li = $(this).closest('li')
                        axios.delete(url).then(res => {
                            li.hide(300, function () {
                                $(this).remove();
                            })
                            swal('删除！', '你的一篇游记已经被删除。', 'success')
                        }).catch(err => {
                            let errors = err.response.data.errors;
                            swal('错误啦！', Object.values(errors).join("\r\n"), 'error')
                        })
                    })
            })

            // 获取当前地理位置
            $.getScript('http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js', function () {
                if ($('#province').val() === '') {
                    $('#province').val(remote_ip_info.province)
                }
                if ($('#city').val() === '') {
                    $('#city').val(remote_ip_info.city)
                }
            })
        })

        /**
         * 编辑器
         */
        function initEdit() {
            editor.customConfig.zIndex = 1
            editor.customConfig.uploadFileName = 'files[]'
            editor.customConfig.uploadImgServer = '/upload/images'
            editor.customConfig.uploadImgParams = {_token: document.querySelector('meta[name="csrf-token"]').content}
            editor.customConfig.onchange = function (html) {
                $('[name="body"]').val(html)
            }
            editor.create()

            let t = $('[name="body"]').val()
            editor.txt.html(t);
        }

        /**
         * 发布
         * @param status draft:草稿
         */
        function release(status = 'draft') {
            let param = new FormData(document.getElementById('releaseForm'))
            param.append('status', status)
            param.append('_method', 'PUT')
            param.append('_token', $('meta[name="csrf-token"]').attr('content'))
            $.ajax({
                url: "{{ route('home.travel.update', $travel) }}",
                type: "POST",
                data: param,
                contentType: false,
                processData: false,
                success(res) {
                    swal({
                        title: '干得漂亮，操作成功！',
                        text: res.message,
                        type: 'success',
                        showCancelButton: true,
                        confirmButtonText: '返回个人主页',
                        cancelButtonText: '重新修改',
                        closeOnConfirm: false,
                    }, function (isConfirm) {
                        if(isConfirm){
                            location.href = "{{ route('home') }}"
                        }
                    })
                },
                error(err) {
                    let errors = err.responseJSON.errors;
                    swal('错误啦！', Object.values(errors).join("\r\n"), 'error')
                }
            })
        }
    </script>
@endpush