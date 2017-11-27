<?php

namespace App\Admin\Controllers;

use App\Models\Area;
use App\Models\City;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class CityController extends Controller
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

            $content->header('城市');
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

            $content->header('城市');
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

            $content->header('城市');
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
        return Admin::grid(City::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            $grid->title('城市')->sortable()->editable();
            $grid->hide('隐藏?')->sortable()->switch(['on' => ['text' => 'YES'], 'off' => ['text' => 'NO']]);
            $grid->created_at('创建日期');
            $grid->updated_at('修改日期');

            $grid->filter(function ($filter) {
                $filter->like('title', '城市');
                $filter->in('area_id', '所在区域')->multipleSelect('/admin/api/areas');
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
        return Admin::form(City::class, function (Form $form) {

            $form->display('id', 'ID');

            $form->select('area_id', '所在区域')->rules('required')->options(function ($id) {
                if ($area = Area::find($id)) {
                    return $area->pluck('title', 'id');
                }
            })->ajax('/admin/api/areas');

            $form->text('title', '城市')->rules('required');
            $form->number('order', '排序');
            $form->switch('hide', '隐藏?');
            $form->display('created_at', '创建日期');
            $form->display('updated_at', '修改日期');
        });
    }
}
