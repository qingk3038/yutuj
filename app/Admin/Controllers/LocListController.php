<?php

namespace App\Admin\Controllers;

use App\Models\LocList;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Http\Request;

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
            $grid->model()->province();
            $grid->id();
            $grid->name('国家')->editable();

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
            $form->text('code', '代码');
        });
    }

    public function city(Request $request)
    {
        $provinceId = $request->get('q');
        return LocList::city()->where('parent_id', $provinceId)->get(['id', 'name as text']);
    }

    public function district(Request $request)
    {
        $cityId = $request->get('q');
        return LocList::district()->where('parent_id', $cityId)->get(['id', 'name as text']);
    }
}