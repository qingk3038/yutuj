/**
 * 开发者 bing
 * qq 676659348
 */

(function ($) {
    $(document).ready(function () {
        // 搜索
        $('.search-item').click(function () {
            let pid = $(this).attr('pid');
            $('#search-btn').text($(this).text());
            $('#pid').val(pid);
            $(this).addClass('active').siblings().removeClass('active')
        })

        // 商务通
        $('.swt').click(function (event) {
            event.preventDefault()
            openZoosUrl('chatwin');
        })

        // 返回顶部
        $('.return-top').click(function () {
            $('body,html').animate({scrollTop: 0}, 500)
        })

        // 内容标题格式
        $('.div-bodyapp').find('h1, h2, h3, h4, h5, h6').addClass('left-border-orange text-truncate')

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

})(jQuery)

$(document).ready(function () {
    // 绑定滑动事件
    document.querySelectorAll('[data-ride]').forEach((v, i) => {
        let hammer = new Hammer(v);
        hammer.on("swipeleft", function () {
            $(v).carousel('next');
        }).on("swiperight", function () {
            $(v).carousel('prev');
        })
    })

    // 个人主页 更新信息 完成
    $('.do-complete').click(function () {
        let param = $('#info').serialize();
        axios.put($('#info').attr('action'), param).then(res => {
            location.href = document.referrer
        }).catch(err => {
            let errors = err.response.data.errors;
            swal('失败！', Object.values(errors).join("\r\n"), 'warning')
        })
    })
})

// 无限滚动
$(document).ready(initInfiniteScroll)

function initInfiniteScroll() {
    $container = $('.infiniteScroll').infiniteScroll({
        path: '.pagination a[rel="next"]',
        append: '.item',
        status: '.page-load-status',
        scrollThreshold: 0,
        hideNav: '.pagination',
        history: false,
        debug: true,
    })
}