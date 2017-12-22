<?php

namespace App\Admin\Controllers;

use App\Models\Leader;

use App\Models\LocList;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

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
            $grid->model()->with(['country', 'province', 'city', 'district'])->withCount('activities');
            $grid->id('ID')->sortable();

            $grid->avatar('头像')->image(null, 120);
            $grid->name('名字');
            $grid->column('activities_count', '活动数')->badge();
            $grid->photos('风采图')->count()->badge();
            $grid->sex('性别')->display(function ($sex) {
                return $sex === 'F' ? '女' : '男';
            })->badge();
            $grid->column('all_city', '显示地址')->display(function () {
                return array_filter([
                    $this->country['name'] ?? null,
                    $this->province['name'] ?? null,
                    $this->city['name'] ?? null,
                ]);
            })->label();
            $grid->created_at('创建日期');
            $grid->updated_at('修改日期');

            $grid->actions(function ($actions) {
                $a = sprintf('<a href="%s" target="_blank"><i class="fa fa-fw fa-paper-plane"></i></a>', route('www.leader.show', $actions->row));
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
        return Admin::form(Leader::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('name', '名字')->rules('required|string');
            $form->image('avatar', '头像')->rules('required');
            $form->image('bg_home', '主页背景')->rules('required')->uniqueName();
            $form->multipleImage('photos', '展示图')->removable()->uniqueName();

            $form->switch('sex', '性别')->states([
                'on' => ['value' => 'F', 'text' => '女性', 'color' => 'warning'],
                'off' => ['value' => 'M', 'text' => '男性', 'color' => 'success'],
            ])->default('M');

            $form->select('country_id', '国家')->options(
                LocList::country()->pluck('name', 'id')
            )->load('province_id', '/admin/api/province')->rules('required');

            $form->select('province_id', '省份')->options(
                LocList::province()->pluck('name', 'id')
            )->load('city_id', '/admin/api/city')->rules('required');

            $form->select('city_id', '城市')->options(function ($id) {
                return LocList::options($id);
            })->load('district_id', '/admin/api/district');

            $form->select('district_id', '地区')->options(function ($id) {
                return LocList::options($id);
            });

            $form->text('brief', '简短简介')->rules('required|string|max:150');
            $form->textarea('description', '描述')->rules('required|string|between:20,350');
            $form->textarea('introduction', '个人介绍')->rules('required|string|between:20,2000')->rows(10);
            $form->display('created_at', '创建日期');
            $form->display('updated_at', '修改日期');
        });
    }
}
