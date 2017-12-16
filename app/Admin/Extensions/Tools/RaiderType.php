<?php

namespace App\Admin\Extensions\Tools;

use Encore\Admin\Admin;
use Encore\Admin\Grid\Tools\AbstractTool;
use Illuminate\Support\Facades\Request;

class RaiderType extends AbstractTool
{
    protected function script()
    {
        $url = Request::fullUrlWithQuery(['type' => '_type_']);

        return <<<EOT

$('input:radio.raider-type').change(function () {
    var url = "$url".replace('_type_', $(this).val());
    $.pjax({container:'#pjax-container', url: url });
});

EOT;
    }

    public function render()
    {
        Admin::script($this->script());
        $types = ['default' => '默认', 'line' => '路线攻略', 'food' => '美食攻略', 'hospital' => '住宿攻略', 'scenic' => '景点攻略'];
        $options = array_merge(['all' => '全部'], $types);

        return view('admin.tools.raider', compact('options'));
    }
}