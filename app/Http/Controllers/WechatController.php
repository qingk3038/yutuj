<?php

namespace App\Http\Controllers;

use EasyWeChat\OfficialAccount\Application;

class WechatController extends Controller
{
    public function __invoke(Application $app)
    {
        $app->server->push(function ($message) {
            return '您好!此公众号没有开发功能。';
        });
        return $app->server->serve();
    }
}
