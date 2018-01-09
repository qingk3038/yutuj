@extends('layouts.home')

@section('body')
    <h5 class="px-3 pt-3 m-0">我的消息</h5>
    <!--<div class="bg-light p-5 mt-4 text-center"><img src="../img/empty_message.png" alt="empty_message" width="140" height="125"></div>-->
    <hr>
    <div class="px-4">
        <table class="table list-message text-muted">
            <tr>
                <td><input type="checkbox"></td>
                <td>
                    <div class="position-relative">
                        <img src="../img/icon_master.png" alt="icon_master" width="32" height="32">
                        <!--<i class="position-absolute unread"></i>-->
                    </div>
                </td>
                <td>
                    <h6 class="text-dark">管理员给我发来了站内通知：</h6>
                    “欢迎加入遇途记，有您的相伴，是我们最大的荣幸！”
                </td>
                <td class="text-right text-nowrap">2017-07-12 13:52</td>
            </tr>
            <tr>
                <td><input type="checkbox"></td>
                <td>
                    <div class="position-relative">
                        <img src="../img/icon_message.png" alt="icon_message" width="32" height="32">
                        <i class="position-absolute unread"></i>
                    </div>
                </td>
                <td>
                    <h6 class="text-dark">系统通知：</h6>
                    亲爱的土豆豆：
                    <br>你的游记《上海迪士尼一日游》已经成功发表，可以招呼亲朋好友们一起来欣赏你的大作啦~
                    <br><a href="#">点击查看游记&gt;&gt;</a>
                </td>
                <td class="text-right text-nowrap">2017-07-12 13:52</td>
            </tr>
            <tr>
                <td colspan="4">
                    <label class="mr-3">
                        <input type="checkbox"> 批量设置
                    </label>
                    <span class="btn btn-outline-secondary btn-sm">全选</span>
                    <span class="btn btn-outline-secondary btn-sm">已读</span>
                    <span class="btn btn-outline-secondary btn-sm">删除</span>
                </td>
            </tr>
        </table>
    </div>
    <nav class="px-3">
        <ul class="pagination justify-content-end">
            <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1">首页</a></li>
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">下一页</a></li>
        </ul>
    </nav>
@endsection