@extends('layouts.m')

@section('title', '发布游记')

@section('header')
    @include('m.header', ['title' => '发布游记', 'theme' => 'white'])
@endsection

@section('content')
    <div class="container-fluid mt-5 py-3">
        <form id="releaseForm">
            <input type="hidden" name="province" id="province">
            <input type="hidden" name="city" id="city">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="请输入游记标题" name="title">
            </div>
            <div class="form-group">
                <label class="custom-file">
                    <input type="file" id="thumb" name="thumb" class="custom-file-input">
                    <span class="custom-file-label">选择游记封面</span>
                </label>
            </div>
            <div class="form-group">
                <textarea name="description" class="form-control text-muted" rows="3" placeholder="游记的摘要也很重要…"></textarea>
            </div>
            <div class="form-group">
                <div id="edit"></div>
                <textarea name="body" hidden class="form-control" rows="10" placeholder="请在这里编辑游记内容"></textarea>
            </div>
            <div class="row">
                <div class="col">
                    <span class="btn btn-warning btn-sm btn-block" onclick="release('audit')">确认发表</span>
                </div>
                <div class="col">
                    <span class="btn btn-outline-warning btn-sm btn-block" onclick="release('draft')">保存草稿</span>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('footer', false)


@push('script')
    <link rel="stylesheet" href="{{ asset('/vendor/wangEditor-3.0.14/release/wangEditor.min.css') }}">
    <script src="{{ asset('/vendor/wangEditor-3.0.14/release/wangEditor.min.js') }}"></script>
    <script>
        let editor = new wangEditor('#edit')
        // 自定义菜单配置
        editor.customConfig.menus = [
            'bold',  // 粗体
            'underline',  // 下划线
            'foreColor',  // 文字颜色
            'link',  // 插入链接
            'list',  // 列表
            'justify',  // 对齐方式
            'image',  // 插入图片
            'table',  // 表格
            'video',  // 插入视频
        ]

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
         * 发布修改
         * @param status draft:草稿
         */
        function release(status = 'draft') {
            let param = $('#releaseForm').serialize() + '&' + $.param({status});
            axios.post("{{ route('home.travel.store') }}", param)
                .then(res => {
                    swal({
                            title: '干得漂亮，操作成功！',
                            text: res.data.message,
                            type: 'success',
                            showCancelButton: true,
                            confirmButtonText: '返回个人主页',
                            cancelButtonText: '继续发布',
                            closeOnConfirm: false,
                            closeOnCancel: false
                        },
                        function (isConfirm) {
                            isConfirm ? location.href = "{{ route('home') }}" : location.reload(true)
                        })
                })
                .catch(err => {
                    let errors = err.response.data.errors;
                    swal('错误啦！', Object.values(errors).join("\r\n"), 'error')
                })
        }
    </script>
@endpush