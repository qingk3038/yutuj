<?php

namespace App\Admin\Controllers;

use App\Models\Lanmu;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class LanmuController extends Controller
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

            $content->header('栏目');
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

            $content->header('栏目');
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

            $content->header('栏目');
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
        return Admin::grid(Lanmu::class, function (Grid $grid) {
            $grid->model()->withCount('articles');

            $grid->id('ID')->sortable();
            $grid->title('标题')->sortable()->editable();

            $grid->hide('隐藏?')->sortable()->switch(['on' => ['text' => 'YES'], 'off' => ['text' => 'NO']]);
            $grid->column('articles_count', '文章数')->display(function ($count) {
                return "<span class='label label-warning'>{$count}</span>";
            });

            $grid->created_at('创建日期');
            $grid->updated_at('更新日期');

            $grid->filter(function ($filter) {
                $filter->like('title', '栏目');
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
        return Admin::form(Lanmu::class, function (Form $form) {
            $form->display('id', 'ID');

            $form->select('parent_id', '上级栏目')->options(function () {
                $ap = [0 => '一级栏目'];
                $directors = Lanmu::select('id', 'title')->active()->pluck('title', 'id')->toArray();
                return array_merge($ap, $directors);
            });
            $form->text('title', '栏目标题')->rules('required');
            $form->switch('hide', '隐藏?');

            $form->display('created_at', '创建时间');
            $form->display('updated_at', '更新时间');
        });
    }
}
