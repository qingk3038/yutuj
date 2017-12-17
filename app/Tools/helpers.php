<?php
/**
 * 图片裁剪
 */
if (!function_exists('imageCut')) {
    function imageCut($width, $height, $src)
    {
        $url = base64_encode($src);
        return asset("thumb/$width/$height/$url");
    }
}
