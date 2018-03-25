<?php

use App\User;
use Illuminate\Auth\Events\Registered;

/**
 * 图片裁剪
 */

if (!function_exists('imageCut')) {
    function imageCut($width, $height, $src)
    {
        $url = rtrim(strtr(base64_encode($src), '+/', '-_'), '=');
        return asset("thumb/$width/$height/$url");
    }
}

/**
 * 数字转中文
 */
if (!function_exists('numberToChinese')) {
    function numberToChinese($num, $m = 1)
    {
        switch ($m) {
            case 0:
                $CNum = array(
                    array('零', '壹', '贰', '叁', '肆', '伍', '陆', '柒', '捌', '玖'),
                    array('', '拾', '佰', '仟'),
                    array('', '萬', '億', '萬億')
                );
                break;
            default:
                $CNum = array(
                    array('零', '一', '二', '三', '四', '五', '六', '七', '八', '九'),
                    array('', '十', '百', '千'),
                    array('', '万', '亿', '万亿')
                );
                break;
        }

        if (!is_numeric($num)) {
            return false;
        }

        $flt = '';
        if (is_integer($num)) {
            $num = strval($num);
        } else if (is_numeric($num)) {
            $num = strval($num);
            $rs = explode('.', $num, 2);
            $num = $rs[0];
            $flt = $rs[1];
        }

        $len = strlen($num);
        $num = strrev($num);
        $chinese = '';

        for ($i = 0, $k = 0; $i < $len; $i += 4, $k++) {
            $tmp_str = '';
            $str = strrev(substr($num, $i, 4));
            $str = str_pad($str, 4, '0', STR_PAD_LEFT);
            for ($j = 0; $j < 4; $j++) {
                if ($str{$j} !== '0') {
                    $tmp_str .= $CNum[0][$str{$j}] . $CNum[1][4 - 1 - $j];
                }
            }
            $tmp_str .= $CNum[2][$k];
            $chinese = $tmp_str . $chinese;
            unset($str);
        }
        if ($flt !== '') {
            $str = '';
            for ($i = 0; $i < strlen($flt); $i++) {
                $str .= $CNum[0][$flt{$i}];
            }
            $chinese .= "点{$str}";
        }
        return $chinese;
    }
}

// 微信登录
if (!function_exists('wechatLogin')) {
    function wechatLogin($user)
    {
        if (!$wx_user = User::where('wx_id', $user->getId())->first()) {
            $wx_user = User::create([
                'wx_id' => $user->getId(),
                'email' => $user->getEmail(),
                'name' => $user->getNickname(),
                'password' => bcrypt(str_random(6)),
                'sex' => array_get($user->getOriginal(), 'sex') === 1 ? 'M' : 'F',
                'province' => array_get($user->getOriginal(), 'province'),
                'city' => array_get($user->getOriginal(), 'city'),
                'avatar' => $user->getAvatar()
            ]);
            event(new Registered($wx_user));
        }

        // 禁止登陆
        abort_if($wx_user->disable, 403);

        auth()->login($wx_user);
        return redirect()->intended('/home');
    }
}