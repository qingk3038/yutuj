<?php

namespace App\Admin\Extensions\Tools;

use Encore\Admin\Admin;
use Encore\Admin\Grid\Tools\AbstractTool;
use Illuminate\Support\Facades\Request;

class TravelAudit extends AbstractTool
{
    protected function script()
    {
        $url = Request::fullUrlWithQuery(['status' => '_status_']);

        return <<<EOT

$('input:radio.travel-status').change(function () {
    var url = "$url".replace('_status_', $(this).val());
    $.pjax({container:'#pjax-container', url: url });
});

EOT;
    }

    public function render()
    {
        Admin::script($this->script());

        $options = [
            'audit' => '等待审核',
            'adopt' => '通过',
            'reject' => '拒绝',
            'draft' => '草稿箱',
        ];

        return view('admin.tools.travel', compact('options'));
    }
}