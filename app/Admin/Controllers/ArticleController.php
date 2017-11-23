<?php

namespace App\Admin\Controllers;

use App\Models\Article;

use App\Models\Lanmu;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class ArticleController extends Controller
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

            $content->header('文章');
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

            $content->header('文章');
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

            $content->header('文章');
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
        return Admin::grid(Article::class, function (Grid $grid) {
            $grid->id('ID')->sortable();
            $grid->column('title', '标题')->sortable()->editable();
            $grid->column('click', '点击量')->sortable()->editable();
            $grid->column('admin.name', '作者')->sortable();
            $grid->created_at('创建日期');
            $grid->updated_at('更新日期');

            $grid->filter(function ($filter) {
                $filter->equal('lanmu_id', '栏目')->select(function () {
                    return Lanmu::select('id', 'title')->active()->pluck('title', 'id')->toArray();
                });
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
        return Admin::form(Article::class, function (Form $form) {

            $form->display('id', 'ID');

            $form->select('lanmu_id', '文章栏目')->rules('required')->options(function () {
                return Lanmu::select('id', 'title')->active()->pluck('title', 'id')->toArray();
            });

            $form->text('title', '标题')->rules('required');
            $form->tags('keywords', '关键词')->default([]);
            $form->image('thumb', '缩略图')->removable();
            $form->textarea('description', '简介');
            $form->editor('data.content', '内容')->rules('required|max:9999');
            $form->number('click', '点击量')->default(random_int(111, 9999));

            $form->hidden('user_id')->default(Admin::user()->id);
            $form->display('created_at', '创建日期');
            $form->display('updated_at', '更新日期');

        });
    }
}
