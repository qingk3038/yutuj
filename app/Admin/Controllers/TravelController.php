<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\Tools\TravelStatusButtons;
use App\Events\TravelStatusChange;
use App\Models\Travel;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class TravelController extends Controller
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

            $content->header('审核游记');
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

            $content->header('审核游记');
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

            $content->header('审核游记');
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
        return Admin::grid(Travel::class, function (Grid $grid) {
            $grid->model()->with('user')->where('status', request('status', 'audit'));

            $grid->id('ID')->sortable();
            $grid->thumb('缩略图')->sortable()->image(null, 120, 120);
            $grid->title('标题')->sortable()->limit(30);
            $grid->click('点击量')->sortable();
            $grid->column('full', '省份/城市')->display(function () {
                return [$this->province, $this->city];
            })->badge();
            $grid->column('user.name', '作者');
            $grid->created_at('创建日期');
            $grid->updated_at('修改日期');
            $grid->status('快速审核')->sortable()->radio([
                'draft' => '草稿箱',
                'audit' => '等待审核',
                'adopt' => '审核通过',
                'reject' => '审核拒绝',
            ]);
            $grid->tools(function ($tools) {
                $tools->append(new TravelStatusButtons());
            });
            $grid->disableCreateButton();

            $grid->actions(function ($actions) {
                $a = sprintf('<a href="%s" target="_blank"><i class="fa fa-fw fa-paper-plane"></i></a>', route('travel.show', $actions->row));
                $actions->prepend($a);
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
        return Admin::form(Travel::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('title', '标题')->rules('required');
            $form->image('thumb', '缩略图')->rules('required')->uniqueName();
            $form->textarea('description', '摘要')->rules('required|between:10,350');
            $form->editor('body', '游记内容')->rules('required|min:20');

            $form->text('province', '省份');
            $form->text('city', '城市');
            $form->number('click', '点击量');
            $form->radio('status', '审核状态')->options([
                'draft' => '草稿箱', 'audit' => '等待审核', 'adopt' => '通过', 'reject' => '拒绝',
            ]);
            $form->display('user.name', '游记作者');
            $form->display('created_at', '创建日期');
            $form->display('updated_at', '修改日期');
        });
    }
}
