<?php

namespace App\Admin\Controllers;

use App\Models\Customized;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class CustomizedController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('定制游');
            $content->description('list');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('定制游');
            $content->description('edit');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('定制游');
            $content->description('create');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Customized::class, function (Grid $grid) {
            $grid->model()->latest()->with('user');
            $grid->id('ID')->sortable();
            $grid->type('来源');
            $grid->title('想去地址');
            $grid->mobile('手机号');
            $grid->column('read', '处理')->switch([
                'on' => ['value' => 1, 'text' => '已读', 'color' => 'primary'],
                'off' => ['value' => 0, 'text' => '未读', 'color' => 'default'],
            ]);
            $grid->column('user.name', '会员')->display(function ($username) {
                return $username ?: '匿名';
            });
            $grid->created_at('创建日期');
            $grid->updated_at('修改日期');

            $grid->filter(function ($filter) {
                $filter->equal('type', '数据来源')->radio(['' => '全部', 'PC' => '电脑端', 'Mobile' => '移动端']);
                $filter->equal('read', '是否处理')->radio(['' => '全部', 1 => '已读', 0 => '未读']);
                $filter->equal('mobile', '手机号')->mobile();
                $filter->between('created_at', '创建时间')->datetime();
            });
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Customized::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('title', '想去地址');
            $form->mobile('mobile', '手机号');
            $form->radio('type', '数据来源')->options(['PC' => '电脑端', 'Mobile' => '移动端'])->default('PC');
            $form->switch('read', '处理')->states([
                'on' => ['value' => 1, 'text' => 'Yes'],
                'off' => ['value' => 0, 'text' => 'No'],
            ])->default(1);
            $form->display('created_at', '创建日期');
            $form->display('updated_at', '修改日期');
        });
    }
}
