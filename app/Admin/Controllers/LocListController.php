<?php

namespace App\Admin\Controllers;

use App\Models\LocList;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class LocListController extends Controller
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

            $content->header('世界城市');
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

            $content->header('世界城市');
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

            $content->header('世界城市');
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
        return Admin::grid(LocList::class, function (Grid $grid) {
            $grid->id('ID')->sortable();
            $grid->name('名称')->sortable();
            $grid->code('简称')->sortable();
            $grid->type('类别')->sortable()->display(function ($type) {
                if($type === 'country') return '国家';
                if($type === 'state') return '省份';
                if($type === 'city') return '城市';
                if($type === 'region') return '地区';
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
        return Admin::form(LocList::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('name', '名称');
        });
    }
}