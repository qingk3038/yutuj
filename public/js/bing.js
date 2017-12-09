/**
 * 开发者 Bing
 * QQ 676659348
 * 请保留开发者权利，生存不易，勿删！
 */

$(document).ready(function () {
    $('[data-toggle]').popover();

    // 侧边
    $('.side-right .top').click(function () {
        $('body,html').animate({scrollTop: 0}, 1000);
    })
    $('.side-right .swt').click(function () {
        alert('还未开通在线客服。');
    })
})