/**
 * 开发者 Bing
 * QQ 676659348
 * 请保留开发者权利，生存不易，勿删！
 */

$(document).ready(function () {
    $('[data-toggle="popover"]').popover()

    // 侧边
    $('.side-right .top').click(function () {
        $('body,html').animate({scrollTop: 0}, 1000)
    })

    // 商务通
    $('.swt').click(function (event) {
        event.preventDefault()
        openZoosUrl('chatwin');
    })

    // 搜索栏搜索
    $('.search-item').click(function () {
        let pid = $(this).attr('pid')
        $('#search-btn').text($(this).text())
        $('#pid').val(pid)
        $(this).addClass('active').siblings().removeClass('active')
    })

    // 热门关键词
    $('.hot-keywords > a').click(function () {
        $('#q').val($(this).text())
    })

    // 搜索提交
    $('.top-search').submit(function (event) {
        if ($('#q').val().length < 2) {
            event.preventDefault()
            swal({
                title: '搜索提醒',
                text: '请您至少输入2个字进行搜索',
                type: 'warning',
                timer: 2000
            })
        }
    })

    // 设置默认显示地区
    showDq()
})

function showDq() {
    let pid = $('#pid').val()
    if (pid !== '') {
        let dq = $('.search-item[pid="' + pid + '"]').addClass('active').text()
        $('#search-btn').text(dq)
    } else {
        $('.search-item:not([pid])').addClass('active')
    }
}

function authComplete() {
    location.reload()
}