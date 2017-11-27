<?php

namespace App\Admin\Controllers;

use App\Models\Leader;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Support\Facades\Storage;

class LeaderController extends Controller
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

            $content->header('领队');
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

            $content->header('领队');
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

            $content->header('领队');
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
        return Admin::grid(Leader::class, function (Grid $grid) {

//            $grid->model()->withCount('activities');

            $grid->id('ID')->sortable();
            $grid->thumb('头像')->image();
            $grid->title('领队')->sortable();

            /*$grid->column('activities_count', '活动数')->display(function ($count) {
                return "<span class='label label-warning'>{$count}</span>";
            });*/

            $grid->column('sex', '性别')->sortable()->display(function ($sex) {
                return $sex === 'F' ? '女' : '男';
            });

            $grid->column('photos', '展示图')->display(function ($photos) {
                $count = count($photos);
                return "<span class='label label-info'>{$count}张</span>";
            });

            $grid->hide('隐藏?')->sortable()->switch(['on' => ['text' => 'YES'], 'off' => ['text' => 'NO']]);

            $grid->created_at('创建时间');
            $grid->updated_at('修改时间');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Leader::class, function (Form $form) {
            $form->display('id', 'ID');
            $form->text('title', '领队')->rules('required');
            $form->textarea('description', '简介');
            $form->image('thumb', '缩略图')->removable();
            $form->multipleFile('photos', '个人展示')->removable();
            $form->radio('sex', '性别')->options(['F' => '女性', 'M' => '男性'])->default('F');
            $form->switch('hide', '隐藏?')->default('Off');
            $form->display('created_at', '创建时间');
            $form->display('updated_at', '修改时间');
        });
    }
}
