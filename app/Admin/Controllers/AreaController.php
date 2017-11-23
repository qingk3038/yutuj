<?php

namespace App\Admin\Controllers;

use App\Models\Area;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class AreaController extends Controller
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

            $content->header('区域');
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

            $content->header('区域');
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

            $content->header('区域');
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
        return Admin::grid(Area::class, function (Grid $grid) {
            $grid->model()->orderBy('order' ,'asc');

            $grid->id('ID')->sortable();
            $grid->title('区域')->sortable()->editable();
            $grid->hide('隐藏?')->sortable()->switch(['on' => ['text' => 'YES'], 'off' => ['text' => 'NO']]);
            $grid->citys('城市数')->count()->display(function ($count) {
                return "<span class='label label-warning'>{$count}</span>";
            });
            $grid->created_at('创建日期');
            $grid->updated_at('修改日期');

            $grid->filter(function($filter){
                $filter->like('title', '区域');
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
        return Admin::form(Area::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('title', '区域')->rules('required');
            $form->number('order', '排序');
            $form->switch('hide', '隐藏?');
            $form->display('created_at', '创建日期');
            $form->display('updated_at', '修改日期');
        });
    }
}
