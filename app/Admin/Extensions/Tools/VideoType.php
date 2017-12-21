<?php

namespace App\Admin\Extensions\Tools;

use Encore\Admin\Admin;
use Encore\Admin\Grid\Tools\AbstractTool;
use Illuminate\Support\Facades\Request;


class VideoType extends AbstractTool
{
    protected function script()
    {
        $url = Request::fullUrlWithQuery(['type' => '_type_']);

        return <<<EOT

$('input:radio.video-type').change(function () {
    var url = "$url".replace('_type_', $(this).val());
    $.pjax({container:'#pjax-container', url: url });
});

EOT;
    }

    public function render()
    {
        Admin::script($this->script());

        $options = [
            'film' => '短拍',
            'live' => '直播',
        ];

        return view('admin.tools.video', compact('options'));
    }
}