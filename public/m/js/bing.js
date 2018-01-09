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