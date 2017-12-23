@extends('layouts.app')

@section('title', sprintf('搜索"%s"的结果', request('q')))

@section('content')
    <div class="container">
        <div class="py-4"><a href="index.html">首页</a> &gt; <span class="text-warning">搜索“成都”</span></div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-8">
                <div class="bg-white p-3 mb-4 list-media">
                    <ul class="nav" style="margin-left: -15px;">
                        <li class="nav-item">
                            <a href="javascript:void(0);" class="nav-link active">活动线路</a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void(0);" class="nav-link">纵横西部</a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void(0);" class="nav-link">微上西部</a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void(0);" class="nav-link">超级周末</a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void(0);" class="nav-link">最6旅行</a>
                        </li>
                    </ul>
                    <hr class="mt-0">
                    <div class="media">
                        <div class="mr-3 position-relative">
                            <a href="activity.blade.php"><img src="{{ asset('uploads/d/list_pic.jpg') }}" alt="Generic placeholder image" width="280" height="180"></a>
                            <span class="bg-warning text-white text-center p-1 position-absolute day">
                        <b>1</b> <br>DAY
                    </span>
                        </div>
                        <div class="media-body">
                            <a href="activity.blade.php" class="text-warning d-block">
                                <h3>漫步老成都</h3>
                                <h5>微服私访入蓉城，一街一尘皆故事</h5>
                            </a>
                            <p class="pt-2">
                                <span class="text-info pr-3">行程</span>
                                人民公园—宽窄巷子—奎星楼—锦里—东郊记忆—成都博物馆—望江楼公园
                            </p>
                            <p class="text-muted">
                                <small>如今，当你走在琴台路上，在那块块铺路石上，你依稀可以看到司马相如和卓文君为追求自由爱情，冲破封建枷锁而私奔的脚印，依稀可以看到卓文君和司马相如的那段文君当垆的故事，琴台路上的那架古琴，仿佛仍然在演奏着《凤求凰》，那低沉婉转的琴声，在天府之国的上空飘荡，他们那段浪漫的爱情故事，传颂了千年百年。</small>
                            </p>
                            <h5 class="d-flex justify-content-between">
                                <a href="javascript:void(0);" class="btn-fatuan text-info">出团日期 <i class="fa fa-lg fa-caret-down"></i></a>
                                <span>￥360/人</span>
                            </h5>
                            <div class="list-fatuan d-none">
                                <table class="table text-nowrap ">
                                    <tr>
                                        <td class="align-middle">017-12-03 - 2017-12-03</td>
                                        <td class="align-middle text-muted">已报名 33 人</td>
                                        <td class="align-middle text-danger">360元/人</td>
                                        <td class="align-middle text-right"><a href="#" class="btn btn-warning text-white btn-sm rounded-0">去报名</a></td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">017-12-03 - 2017-12-03</td>
                                        <td class="align-middle text-muted">已报名 33 人</td>
                                        <td class="align-middle text-danger">360元/人</td>
                                        <td class="align-middle text-right"><a href="#" class="btn btn-warning text-white btn-sm rounded-0">去报名</a></td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">017-12-03 - 2017-12-03</td>
                                        <td class="align-middle text-muted">已报名 33 人</td>
                                        <td class="align-middle text-danger">360元/人</td>
                                        <td class="align-middle text-right"><a href="#" class="btn btn-warning text-white btn-sm rounded-0">去报名</a></td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">017-12-03 - 2017-12-03</td>
                                        <td class="align-middle text-muted">已报名 33 人</td>
                                        <td class="align-middle text-danger">360元/人</td>
                                        <td class="align-middle text-right"><a href="#" class="btn btn-warning text-white btn-sm rounded-0">去报名</a></td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">017-12-03 - 2017-12-03</td>
                                        <td class="align-middle text-muted">已报名 33 人</td>
                                        <td class="align-middle text-danger">360元/人</td>
                                        <td class="align-middle text-right"><a href="#" class="btn btn-warning text-white btn-sm rounded-0">去报名</a></td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">017-12-03 - 2017-12-03</td>
                                        <td class="align-middle text-muted">已报名 33 人</td>
                                        <td class="align-middle text-danger">360元/人</td>
                                        <td class="align-middle text-right"><a href="#" class="btn btn-warning text-white btn-sm rounded-0">去报名</a></td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">017-12-03 - 2017-12-03</td>
                                        <td class="align-middle text-muted">已报名 33 人</td>
                                        <td class="align-middle text-danger">360元/人</td>
                                        <td class="align-middle text-right"><a href="#" class="btn btn-warning text-white btn-sm rounded-0">去报名</a></td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">017-12-03 - 2017-12-03</td>
                                        <td class="align-middle text-muted">已报名 33 人</td>
                                        <td class="align-middle text-danger">360元/人</td>
                                        <td class="align-middle text-right"><a href="#" class="btn btn-warning text-white btn-sm rounded-0">去报名</a></td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">017-12-03 - 2017-12-03</td>
                                        <td class="align-middle text-muted">已报名 33 人</td>
                                        <td class="align-middle text-danger">360元/人</td>
                                        <td class="align-middle text-right"><a href="#" class="btn btn-warning text-white btn-sm rounded-0">去报名</a></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="media">
                        <div class="mr-3 position-relative">
                            <a href="activity.blade.php"><img src="{{ asset('uploads/d/list_pic.jpg') }}" alt="Generic placeholder image" width="280" height="180"></a>
                            <span class="bg-warning text-white text-center p-1 position-absolute day">
                        <b>1</b> <br>DAY
                    </span>
                        </div>
                        <div class="media-body">
                            <a href="activity.blade.php" class="text-warning d-block">
                                <h3>漫步老成都</h3>
                                <h5>微服私访入蓉城，一街一尘皆故事</h5>
                            </a>
                            <p class="pt-2">
                                <span class="text-info pr-3">行程</span>
                                人民公园—宽窄巷子—奎星楼—锦里—东郊记忆—成都博物馆—望江楼公园
                            </p>
                            <p class="text-muted">
                                <small>如今，当你走在琴台路上，在那块块铺路石上，你依稀可以看到司马相如和卓文君为追求自由爱情，冲破封建枷锁而私奔的脚印，依稀可以看到卓文君和司马相如的那段文君当垆的故事，琴台路上的那架古琴，仿佛仍然在演奏着《凤求凰》，那低沉婉转的琴声，在天府之国的上空飘荡，他们那段浪漫的爱情故事，传颂了千年百年。</small>
                            </p>
                            <h5 class="d-flex justify-content-between">
                                <a href="javascript:void(0);" class="btn-fatuan text-info">出团日期 <i class="fa fa-lg fa-caret-down"></i></a>
                                <span>￥360/人</span>
                            </h5>
                            <div class="list-fatuan d-none">
                                <table class="table text-nowrap ">
                                    <tr>
                                        <td class="align-middle">017-12-03 - 2017-12-03</td>
                                        <td class="align-middle text-muted">已报名 33 人</td>
                                        <td class="align-middle text-danger">360元/人</td>
                                        <td class="align-middle text-right"><a href="#" class="btn btn-warning text-white btn-sm rounded-0">去报名</a></td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">017-12-03 - 2017-12-03</td>
                                        <td class="align-middle text-muted">已报名 33 人</td>
                                        <td class="align-middle text-danger">360元/人</td>
                                        <td class="align-middle text-right"><a href="#" class="btn btn-warning text-white btn-sm rounded-0">去报名</a></td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">017-12-03 - 2017-12-03</td>
                                        <td class="align-middle text-muted">已报名 33 人</td>
                                        <td class="align-middle text-danger">360元/人</td>
                                        <td class="align-middle text-right"><a href="#" class="btn btn-warning text-white btn-sm rounded-0">去报名</a></td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">017-12-03 - 2017-12-03</td>
                                        <td class="align-middle text-muted">已报名 33 人</td>
                                        <td class="align-middle text-danger">360元/人</td>
                                        <td class="align-middle text-right"><a href="#" class="btn btn-warning text-white btn-sm rounded-0">去报名</a></td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">017-12-03 - 2017-12-03</td>
                                        <td class="align-middle text-muted">已报名 33 人</td>
                                        <td class="align-middle text-danger">360元/人</td>
                                        <td class="align-middle text-right"><a href="#" class="btn btn-warning text-white btn-sm rounded-0">去报名</a></td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">017-12-03 - 2017-12-03</td>
                                        <td class="align-middle text-muted">已报名 33 人</td>
                                        <td class="align-middle text-danger">360元/人</td>
                                        <td class="align-middle text-right"><a href="#" class="btn btn-warning text-white btn-sm rounded-0">去报名</a></td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">017-12-03 - 2017-12-03</td>
                                        <td class="align-middle text-muted">已报名 33 人</td>
                                        <td class="align-middle text-danger">360元/人</td>
                                        <td class="align-middle text-right"><a href="#" class="btn btn-warning text-white btn-sm rounded-0">去报名</a></td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">017-12-03 - 2017-12-03</td>
                                        <td class="align-middle text-muted">已报名 33 人</td>
                                        <td class="align-middle text-danger">360元/人</td>
                                        <td class="align-middle text-right"><a href="#" class="btn btn-warning text-white btn-sm rounded-0">去报名</a></td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">017-12-03 - 2017-12-03</td>
                                        <td class="align-middle text-muted">已报名 33 人</td>
                                        <td class="align-middle text-danger">360元/人</td>
                                        <td class="align-middle text-right"><a href="#" class="btn btn-warning text-white btn-sm rounded-0">去报名</a></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="media">
                        <div class="mr-3 position-relative">
                            <a href="activity.blade.php"><img src="{{ asset('uploads/d/list_pic.jpg') }}" alt="Generic placeholder image" width="280" height="180"></a>
                            <span class="bg-warning text-white text-center p-1 position-absolute day">
                        <b>1</b> <br>DAY
                    </span>
                        </div>
                        <div class="media-body">
                            <a href="activity.blade.php" class="text-warning d-block">
                                <h3>漫步老成都</h3>
                                <h5>微服私访入蓉城，一街一尘皆故事</h5>
                            </a>
                            <p class="pt-2">
                                <span class="text-info pr-3">行程</span>
                                人民公园—宽窄巷子—奎星楼—锦里—东郊记忆—成都博物馆—望江楼公园
                            </p>
                            <p class="text-muted">
                                <small>如今，当你走在琴台路上，在那块块铺路石上，你依稀可以看到司马相如和卓文君为追求自由爱情，冲破封建枷锁而私奔的脚印，依稀可以看到卓文君和司马相如的那段文君当垆的故事，琴台路上的那架古琴，仿佛仍然在演奏着《凤求凰》，那低沉婉转的琴声，在天府之国的上空飘荡，他们那段浪漫的爱情故事，传颂了千年百年。</small>
                            </p>
                            <h5 class="d-flex justify-content-between">
                                <a href="javascript:void(0);" class="btn-fatuan text-info">出团日期 <i class="fa fa-lg fa-caret-down"></i></a>
                                <span>￥360/人</span>
                            </h5>
                            <div class="list-fatuan d-none">
                                <table class="table text-nowrap ">
                                    <tr>
                                        <td class="align-middle">017-12-03 - 2017-12-03</td>
                                        <td class="align-middle text-muted">已报名 33 人</td>
                                        <td class="align-middle text-danger">360元/人</td>
                                        <td class="align-middle text-right"><a href="#" class="btn btn-warning text-white btn-sm rounded-0">去报名</a></td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">017-12-03 - 2017-12-03</td>
                                        <td class="align-middle text-muted">已报名 33 人</td>
                                        <td class="align-middle text-danger">360元/人</td>
                                        <td class="align-middle text-right"><a href="#" class="btn btn-warning text-white btn-sm rounded-0">去报名</a></td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">017-12-03 - 2017-12-03</td>
                                        <td class="align-middle text-muted">已报名 33 人</td>
                                        <td class="align-middle text-danger">360元/人</td>
                                        <td class="align-middle text-right"><a href="#" class="btn btn-warning text-white btn-sm rounded-0">去报名</a></td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">017-12-03 - 2017-12-03</td>
                                        <td class="align-middle text-muted">已报名 33 人</td>
                                        <td class="align-middle text-danger">360元/人</td>
                                        <td class="align-middle text-right"><a href="#" class="btn btn-warning text-white btn-sm rounded-0">去报名</a></td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">017-12-03 - 2017-12-03</td>
                                        <td class="align-middle text-muted">已报名 33 人</td>
                                        <td class="align-middle text-danger">360元/人</td>
                                        <td class="align-middle text-right"><a href="#" class="btn btn-warning text-white btn-sm rounded-0">去报名</a></td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">017-12-03 - 2017-12-03</td>
                                        <td class="align-middle text-muted">已报名 33 人</td>
                                        <td class="align-middle text-danger">360元/人</td>
                                        <td class="align-middle text-right"><a href="#" class="btn btn-warning text-white btn-sm rounded-0">去报名</a></td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">017-12-03 - 2017-12-03</td>
                                        <td class="align-middle text-muted">已报名 33 人</td>
                                        <td class="align-middle text-danger">360元/人</td>
                                        <td class="align-middle text-right"><a href="#" class="btn btn-warning text-white btn-sm rounded-0">去报名</a></td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">017-12-03 - 2017-12-03</td>
                                        <td class="align-middle text-muted">已报名 33 人</td>
                                        <td class="align-middle text-danger">360元/人</td>
                                        <td class="align-middle text-right"><a href="#" class="btn btn-warning text-white btn-sm rounded-0">去报名</a></td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">017-12-03 - 2017-12-03</td>
                                        <td class="align-middle text-muted">已报名 33 人</td>
                                        <td class="align-middle text-danger">360元/人</td>
                                        <td class="align-middle text-right"><a href="#" class="btn btn-warning text-white btn-sm rounded-0">去报名</a></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="media">
                        <div class="mr-3 position-relative">
                            <a href="activity.blade.php"><img src="{{ asset('uploads/d/list_pic.jpg') }}" alt="Generic placeholder image" width="280" height="180"></a>
                            <span class="bg-warning text-white text-center p-1 position-absolute day">
                        <b>1</b> <br>DAY
                    </span>
                        </div>
                        <div class="media-body">
                            <a href="activity.blade.php" class="text-warning d-block">
                                <h3>漫步老成都</h3>
                                <h5>微服私访入蓉城，一街一尘皆故事</h5>
                            </a>
                            <p class="pt-2">
                                <span class="text-info pr-3">行程</span>
                                人民公园—宽窄巷子—奎星楼—锦里—东郊记忆—成都博物馆—望江楼公园
                            </p>
                            <p class="text-muted">
                                <small>如今，当你走在琴台路上，在那块块铺路石上，你依稀可以看到司马相如和卓文君为追求自由爱情，冲破封建枷锁而私奔的脚印，依稀可以看到卓文君和司马相如的那段文君当垆的故事，琴台路上的那架古琴，仿佛仍然在演奏着《凤求凰》，那低沉婉转的琴声，在天府之国的上空飘荡，他们那段浪漫的爱情故事，传颂了千年百年。</small>
                            </p>
                            <h5 class="d-flex justify-content-between">
                                <a href="javascript:void(0);" class="btn-fatuan text-info">出团日期 <i class="fa fa-lg fa-caret-down"></i></a>
                                <span>￥360/人</span>
                            </h5>
                            <div class="list-fatuan d-none">
                                <table class="table text-nowrap ">
                                    <tr>
                                        <td class="align-middle">017-12-03 - 2017-12-03</td>
                                        <td class="align-middle text-muted">已报名 33 人</td>
                                        <td class="align-middle text-danger">360元/人</td>
                                        <td class="align-middle text-right"><a href="#" class="btn btn-warning text-white btn-sm rounded-0">去报名</a></td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">017-12-03 - 2017-12-03</td>
                                        <td class="align-middle text-muted">已报名 33 人</td>
                                        <td class="align-middle text-danger">360元/人</td>
                                        <td class="align-middle text-right"><a href="#" class="btn btn-warning text-white btn-sm rounded-0">去报名</a></td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">017-12-03 - 2017-12-03</td>
                                        <td class="align-middle text-muted">已报名 33 人</td>
                                        <td class="align-middle text-danger">360元/人</td>
                                        <td class="align-middle text-right"><a href="#" class="btn btn-warning text-white btn-sm rounded-0">去报名</a></td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">017-12-03 - 2017-12-03</td>
                                        <td class="align-middle text-muted">已报名 33 人</td>
                                        <td class="align-middle text-danger">360元/人</td>
                                        <td class="align-middle text-right"><a href="#" class="btn btn-warning text-white btn-sm rounded-0">去报名</a></td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">017-12-03 - 2017-12-03</td>
                                        <td class="align-middle text-muted">已报名 33 人</td>
                                        <td class="align-middle text-danger">360元/人</td>
                                        <td class="align-middle text-right"><a href="#" class="btn btn-warning text-white btn-sm rounded-0">去报名</a></td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">017-12-03 - 2017-12-03</td>
                                        <td class="align-middle text-muted">已报名 33 人</td>
                                        <td class="align-middle text-danger">360元/人</td>
                                        <td class="align-middle text-right"><a href="#" class="btn btn-warning text-white btn-sm rounded-0">去报名</a></td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">017-12-03 - 2017-12-03</td>
                                        <td class="align-middle text-muted">已报名 33 人</td>
                                        <td class="align-middle text-danger">360元/人</td>
                                        <td class="align-middle text-right"><a href="#" class="btn btn-warning text-white btn-sm rounded-0">去报名</a></td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">017-12-03 - 2017-12-03</td>
                                        <td class="align-middle text-muted">已报名 33 人</td>
                                        <td class="align-middle text-danger">360元/人</td>
                                        <td class="align-middle text-right"><a href="#" class="btn btn-warning text-white btn-sm rounded-0">去报名</a></td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">017-12-03 - 2017-12-03</td>
                                        <td class="align-middle text-muted">已报名 33 人</td>
                                        <td class="align-middle text-danger">360元/人</td>
                                        <td class="align-middle text-right"><a href="#" class="btn btn-warning text-white btn-sm rounded-0">去报名</a></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <nav class="pt-5 w-100">
                        <ul class="pagination justify-content-end">
                            <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1">上一页</a></li>
                            <li class="page-item active"><span class="page-link">1</span></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">下一页</a></li>
                        </ul>
                    </nav>
                </div>

                <div class="bg-white p-3 mb-4 list-media">
                    <ul class="nav" style="margin-left: -15px;">
                        <li class="nav-item">
                            <a href="javascript:void(0);" class="nav-link active">攻略</a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void(0);" class="nav-link">线路</a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void(0);" class="nav-link">景点</a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void(0);" class="nav-link">美食</a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void(0);" class="nav-link">民宿</a>
                        </li>
                    </ul>
                    <hr class="mt-0">
                    <div class="media">
                        <a href="show.html"><img class="mr-3" src="{{ asset('uploads/d/list_pic.jpg') }}" alt="Generic placeholder image" width="280" height="180"></a>
                        <div class="media-body">
                            <a href="show.html" class="text-warning d-block">
                                <h3>漫步老成都</h3>
                                <h5>微服私访入蓉城，一街一尘皆故事</h5>
                            </a>
                            <p class="text-muted">
                                <small>如今，当你走在琴台路上，在那块块铺路石上，你依稀可以看到司马相如和卓文君为追求自由爱情，冲破封建枷锁而私奔的脚印，依稀可以看到卓文君和…</small>
                            </p>
                            <p class="text-muted small">
                                <span class="mr-3"><i class="fa fa-fw fa-map-marker"></i>成都</span>
                                <span class="mr-3"><i class="fa fa-fw fa-eye"></i>10400</span>
                                <span class="mr-3"><i class="fa fa-fw fa-thumbs-o-up"></i>1000</span>
                                <span class="mr-3"><i class="fa fa-fw fa-clock-o"></i>2017-12-12</span>
                            </p>
                        </div>
                    </div>
                    <div class="media">
                        <a href="show.html"><img class="mr-3" src="{{ asset('uploads/d/list_pic.jpg') }}" alt="Generic placeholder image" width="280" height="180"></a>
                        <div class="media-body">
                            <a href="show.html" class="text-warning d-block">
                                <h3>漫步老成都</h3>
                                <h5>微服私访入蓉城，一街一尘皆故事</h5>
                            </a>
                            <p class="text-muted">
                                <small>如今，当你走在琴台路上，在那块块铺路石上，你依稀可以看到司马相如和卓文君为追求自由爱情，冲破封建枷锁而私奔的脚印，依稀可以看到卓文君和…</small>
                            </p>
                            <p class="text-muted small">
                                <span class="mr-3"><i class="fa fa-fw fa-map-marker"></i>成都</span>
                                <span class="mr-3"><i class="fa fa-fw fa-eye"></i>10400</span>
                                <span class="mr-3"><i class="fa fa-fw fa-thumbs-o-up"></i>1000</span>
                                <span class="mr-3"><i class="fa fa-fw fa-clock-o"></i>2017-12-12</span>
                            </p>
                        </div>
                    </div>
                    <div class="media">
                        <a href="show.html"><img class="mr-3" src="{{ asset('uploads/d/list_pic.jpg') }}" alt="Generic placeholder image" width="280" height="180"></a>
                        <div class="media-body">
                            <a href="show.html" class="text-warning d-block">
                                <h3>漫步老成都</h3>
                                <h5>微服私访入蓉城，一街一尘皆故事</h5>
                            </a>
                            <p class="text-muted">
                                <small>如今，当你走在琴台路上，在那块块铺路石上，你依稀可以看到司马相如和卓文君为追求自由爱情，冲破封建枷锁而私奔的脚印，依稀可以看到卓文君和…</small>
                            </p>
                            <p class="text-muted small">
                                <span class="mr-3"><i class="fa fa-fw fa-map-marker"></i>成都</span>
                                <span class="mr-3"><i class="fa fa-fw fa-eye"></i>10400</span>
                                <span class="mr-3"><i class="fa fa-fw fa-thumbs-o-up"></i>1000</span>
                                <span class="mr-3"><i class="fa fa-fw fa-clock-o"></i>2017-12-12</span>
                            </p>
                        </div>
                    </div>
                    <div class="media">
                        <a href="show.html"><img class="mr-3" src="{{ asset('uploads/d/list_pic.jpg') }}" alt="Generic placeholder image" width="280" height="180"></a>
                        <div class="media-body">
                            <a href="show.html" class="text-warning d-block">
                                <h3>漫步老成都</h3>
                                <h5>微服私访入蓉城，一街一尘皆故事</h5>
                            </a>
                            <p class="text-muted">
                                <small>如今，当你走在琴台路上，在那块块铺路石上，你依稀可以看到司马相如和卓文君为追求自由爱情，冲破封建枷锁而私奔的脚印，依稀可以看到卓文君和…</small>
                            </p>
                            <p class="text-muted small">
                                <span class="mr-3"><i class="fa fa-fw fa-map-marker"></i>成都</span>
                                <span class="mr-3"><i class="fa fa-fw fa-eye"></i>10400</span>
                                <span class="mr-3"><i class="fa fa-fw fa-thumbs-o-up"></i>1000</span>
                                <span class="mr-3"><i class="fa fa-fw fa-clock-o"></i>2017-12-12</span>
                            </p>
                        </div>
                    </div>

                    <nav class="pt-5 w-100">
                        <ul class="pagination justify-content-end">
                            <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1">上一页</a></li>
                            <li class="page-item active"><span class="page-link">1</span></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">下一页</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="bg-white p-3 mb-4 list-media">
                    <ul class="nav" style="margin-left: -15px;">
                        <li class="nav-item">
                            <a href="javascript:void(0);" class="nav-link active">游记</a>
                        </li>
                    </ul>
                    <hr class="mt-0">
                    <div class="media">
                        <a href="show.html"><img class="mr-3" src="{{ asset('uploads/d/list_pic.jpg') }}" alt="Generic placeholder image" width="280" height="180"></a>
                        <div class="media-body">
                            <a href="show.html" class="text-warning d-block">
                                <h3>漫步老成都</h3>
                                <h5>微服私访入蓉城，一街一尘皆故事</h5>
                            </a>
                            <p class="text-muted">
                                <small>如今，当你走在琴台路上，在那块块铺路石上，你依稀可以看到司马相如和卓文君为追求自由爱情，冲破封建枷锁而私奔的脚印，依稀可以看到卓文君和…</small>
                            </p>
                            <p class="text-muted small">
                                <span class="mr-3"><i class="fa fa-fw fa-map-marker"></i>成都</span>
                                <span class="mr-3"><i class="fa fa-fw fa-eye"></i>10400</span>
                                <span class="mr-3"><i class="fa fa-fw fa-thumbs-o-up"></i>1000</span>
                                <span class="mr-3"><i class="fa fa-fw fa-clock-o"></i>2017-12-12</span>
                            </p>
                        </div>
                    </div>
                    <div class="media">
                        <a href="show.html"><img class="mr-3" src="{{ asset('uploads/d/list_pic.jpg') }}" alt="Generic placeholder image" width="280" height="180"></a>
                        <div class="media-body">
                            <a href="show.html" class="text-warning d-block">
                                <h3>漫步老成都</h3>
                                <h5>微服私访入蓉城，一街一尘皆故事</h5>
                            </a>
                            <p class="text-muted">
                                <small>如今，当你走在琴台路上，在那块块铺路石上，你依稀可以看到司马相如和卓文君为追求自由爱情，冲破封建枷锁而私奔的脚印，依稀可以看到卓文君和…</small>
                            </p>
                            <p class="text-muted small">
                                <span class="mr-3"><i class="fa fa-fw fa-map-marker"></i>成都</span>
                                <span class="mr-3"><i class="fa fa-fw fa-eye"></i>10400</span>
                                <span class="mr-3"><i class="fa fa-fw fa-thumbs-o-up"></i>1000</span>
                                <span class="mr-3"><i class="fa fa-fw fa-clock-o"></i>2017-12-12</span>
                            </p>
                        </div>
                    </div>
                    <div class="media">
                        <a href="show.html"><img class="mr-3" src="{{ asset('uploads/d/list_pic.jpg') }}" alt="Generic placeholder image" width="280" height="180"></a>
                        <div class="media-body">
                            <a href="show.html" class="text-warning d-block">
                                <h3>漫步老成都</h3>
                                <h5>微服私访入蓉城，一街一尘皆故事</h5>
                            </a>
                            <p class="text-muted">
                                <small>如今，当你走在琴台路上，在那块块铺路石上，你依稀可以看到司马相如和卓文君为追求自由爱情，冲破封建枷锁而私奔的脚印，依稀可以看到卓文君和…</small>
                            </p>
                            <p class="text-muted small">
                                <span class="mr-3"><i class="fa fa-fw fa-map-marker"></i>成都</span>
                                <span class="mr-3"><i class="fa fa-fw fa-eye"></i>10400</span>
                                <span class="mr-3"><i class="fa fa-fw fa-thumbs-o-up"></i>1000</span>
                                <span class="mr-3"><i class="fa fa-fw fa-clock-o"></i>2017-12-12</span>
                            </p>
                        </div>
                    </div>
                    <div class="media">
                        <a href="show.html"><img class="mr-3" src="{{ asset('uploads/d/list_pic.jpg') }}" alt="Generic placeholder image" width="280" height="180"></a>
                        <div class="media-body">
                            <a href="show.html" class="text-warning d-block">
                                <h3>漫步老成都</h3>
                                <h5>微服私访入蓉城，一街一尘皆故事</h5>
                            </a>
                            <p class="text-muted">
                                <small>如今，当你走在琴台路上，在那块块铺路石上，你依稀可以看到司马相如和卓文君为追求自由爱情，冲破封建枷锁而私奔的脚印，依稀可以看到卓文君和…</small>
                            </p>
                            <p class="text-muted small">
                                <span class="mr-3"><i class="fa fa-fw fa-map-marker"></i>成都</span>
                                <span class="mr-3"><i class="fa fa-fw fa-eye"></i>10400</span>
                                <span class="mr-3"><i class="fa fa-fw fa-thumbs-o-up"></i>1000</span>
                                <span class="mr-3"><i class="fa fa-fw fa-clock-o"></i>2017-12-12</span>
                            </p>
                        </div>
                    </div>

                    <nav class="pt-5 w-100">
                        <ul class="pagination justify-content-end">
                            <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1">上一页</a></li>
                            <li class="page-item active"><span class="page-link">1</span></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">下一页</a></li>
                        </ul>
                    </nav>
                </div>

                <div class="bg-white p-3 mb-4 list-video">
                    <ul class="nav" style="margin-left: -15px;">
                        <li class="nav-item">
                            <a href="javascript:void(0);" class="nav-link active">旅途短拍</a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void(0);" class="nav-link">大咖直播</a>
                        </li>
                    </ul>
                    <hr class="mt-0">
                    <div class="row" style="margin: 0 -5px;">
                        <a class="col-6 box" href="video.blade.php">
                            <p class="position-relative">
                                <img class="img-fluid" src="{{ asset('uploads/d/list_video.jpg') }}" alt="list_video" width="380" height="214">
                                <i class="fa fa-2x fa-play-circle-o position-absolute"></i>
                            </p>
                            <h5>成都 · 大熊猫6天5晚自由行</h5>
                            <p class="small text-truncate pl-3">曼谷是一座五光十色的城,以其独有的魅力吸引着来吸引以其独有的魅力吸引着来吸引</p>
                        </a>
                        <a class="col-6 box" href="video.blade.php">
                            <p class="position-relative">
                                <img class="img-fluid" src="{{ asset('uploads/d/list_video.jpg') }}" alt="list_video" width="380" height="214">
                                <i class="fa fa-2x fa-play-circle-o position-absolute"></i>
                            </p>
                            <h5>成都 · 大熊猫6天5晚自由行</h5>
                            <p class="small text-truncate pl-3">曼谷是一座五光十色的城,以其独有的魅力吸引着来吸引以其独有的魅力吸引着来吸引</p>
                        </a>
                        <a class="col-6 box" href="video.blade.php">
                            <p class="position-relative">
                                <img class="img-fluid" src="{{ asset('uploads/d/list_video.jpg') }}" alt="list_video" width="380" height="214">
                                <i class="fa fa-2x fa-play-circle-o position-absolute"></i>
                            </p>
                            <h5>成都 · 大熊猫6天5晚自由行</h5>
                            <p class="small text-truncate pl-3">曼谷是一座五光十色的城,以其独有的魅力吸引着来吸引以其独有的魅力吸引着来吸引</p>
                        </a>

                        <a class="col-6 box" href="video.blade.php">
                            <p class="position-relative">
                                <img class="img-fluid" src="{{ asset('uploads/d/list_video.jpg') }}" alt="list_video" width="380" height="214">
                                <i class="fa fa-2x fa-play-circle-o position-absolute"></i>
                            </p>
                            <h5>成都 · 大熊猫6天5晚自由行</h5>
                            <p class="small text-truncate pl-3">曼谷是一座五光十色的城,以其独有的魅力吸引着来吸引以其独有的魅力吸引着来吸引</p>
                        </a>
                        <a class="col-6 box" href="video.blade.php">
                            <p class="position-relative">
                                <img class="img-fluid" src="{{ asset('uploads/d/list_video.jpg') }}" alt="list_video" width="380" height="214">
                                <i class="fa fa-2x fa-play-circle-o position-absolute"></i>
                            </p>
                            <h5>成都 · 大熊猫6天5晚自由行</h5>
                            <p class="small text-truncate pl-3">曼谷是一座五光十色的城,以其独有的魅力吸引着来吸引以其独有的魅力吸引着来吸引</p>
                        </a>
                        <a class="col-6 box" href="video.blade.php">
                            <p class="position-relative">
                                <img class="img-fluid" src="{{ asset('uploads/d/list_video.jpg') }}" alt="list_video" width="380" height="214">
                                <i class="fa fa-2x fa-play-circle-o position-absolute"></i>
                            </p>
                            <h5>成都 · 大熊猫6天5晚自由行</h5>
                            <p class="small text-truncate pl-3">曼谷是一座五光十色的城,以其独有的魅力吸引着来吸引以其独有的魅力吸引着来吸引</p>
                        </a>
                    </div>

                    <nav class="pt-5 w-100">
                        <ul class="pagination justify-content-end">
                            <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1">上一页</a></li>
                            <li class="page-item active"><span class="page-link">1</span></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">下一页</a></li>
                        </ul>
                    </nav>
                </div>

            </div>
            <div class="col-4 pl-0">
                @include('www.right')
            </div>
        </div>
    </div>
@endsection

@push('script')
    <link href="https://cdn.bootcss.com/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css" rel="stylesheet">
    <script src="https://cdn.bootcss.com/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.js"></script>
    <script>
        (function ($) {
            // 筛选 显示更多
            $('.list-param span').click(function () {
                $(this).children().toggleClass('fa-flip-vertical')
                $(this).parent().prev().toggleClass('text-truncate')
            })

            // 排序
            $('.list-orderBy a').click(function () {
                $(this).closest('.nav').find('a').removeClass('active')
                $(this).addClass('active')
                let fa = $(this).children()
                if (fa.css('opacity') === '1') {
                    fa.toggleClass('fa-flip-vertical')
                }
            })

            // 显示发团日期
            $('a.btn-fatuan').click(function () {
                $(this).children().toggleClass('fa-flip-vertical')
                $(this).closest('div').find('.list-fatuan').toggleClass('d-none').mCustomScrollbar()
            })
        })(jQuery);
    </script>
@endpush