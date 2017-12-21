/**
 * 开发者 Bing
 * QQ 676659348
 * 请保留开发者权利，生存不易，勿删！
 */

$(document).ready(function () {
    $('[data-toggle]').popover()

    // 侧边
    $('.side-right .top').click(function () {
        $('body,html').animate({scrollTop: 0}, 1000)
    })

    // 商务通
    $('.swt').click(function (event) {
        event.preventDefault()
        alert('还未开通在线客服。')
    })

    // 搜索栏搜索
    $('.search-item').click(function () {
        let pid = $(this).attr('pid');
        $('#search-btn').text($(this).text());
        $('#pid').val(pid);
    })

    // 热门关键词
    $('.hot-keywords > a').click(function () {
        $('#q').val($(this).text());
    })

    // 搜索提交
    $('.top-search').submit(function (event) {
        if ($('#q').val() === '') {
            event.preventDefault();
        }
    })

})