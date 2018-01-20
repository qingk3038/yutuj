<?php

namespace App\Admin\Controllers;

use App\Models\Article;

use App\Models\Category;
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
            $grid->model()->with('category');
            $grid->id('ID')->sortable();
            $grid->column('category.title', '栏目');
            $grid->title('标题')->sortable();
            $grid->created_at('创建日期');
            $grid->updated_at('修改日期');

            $grid->filter(function ($filter) {
                $filter->like('title', '标题');
                $filter->in('category_id', '栏目')->select(Category::pluck('title', 'id'));
                $filter->between('updated_at', '更新日期')->datetime();
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
            $form->select('category_id', '栏目')->rules('required')->options(Category::pluck('title', 'id'));
            $form->text('title', '标题')->rules('required|max:100');
            $form->textarea('description', '简介')->rules('required|max:350');
            $form->editor('body', '内容')->rules('required');

            $form->display('created_at', '创建日期');
            $form->display('updated_at', '修改日期');
        });
    }
}
