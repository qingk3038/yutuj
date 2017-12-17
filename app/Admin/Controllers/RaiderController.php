<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\Tools\RaiderType;
use App\Models\LocList;
use App\Models\Nav;
use App\Models\Raider;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class RaiderController extends Controller
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

            $content->header('攻略');
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

            $content->header('攻略');
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

            $content->header('攻略');
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
        return Admin::grid(Raider::class, function (Grid $grid) {
            $grid->model()->withCount('likes')->with('admin')->where('type', request('type', 'default'));

            $grid->id('ID')->sortable();
            $grid->column('type', '类别')->editable('select', ['default' => '默认', 'line' => '路线攻略', 'food' => '美食攻略', 'hospital' => '住宿攻略', 'scenic' => '景点攻略']);
            $grid->column('title', '标题')->editable();
            $grid->column('short', '短标题')->editable();
            $grid->column('click', '点击数')->sortable()->editable();
            $grid->column('likes_count', '点赞数');
            $grid->column('admin.username', '作者');
            $grid->updated_at('修改日期');

            $grid->filter(function ($filter) {
                $filter->in('navs.id', '导航')->multipleSelect(Nav::pluck('text', 'id'));
                $filter->between('created_at', '创建时间')->datetime();
                $filter->between('updated_at', '更新时间')->datetime();
            });

            $grid->tools(function ($tools) {
                $tools->append(new RaiderType());
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
        return Admin::form(Raider::class, function (Form $form) {
            $form->tab('基本信息', function (Form $form) {
                $form->hidden('admin_user_id')->default(Admin::user()->id);

                $form->text('title', '标题')->rules('required|string|max:200');
                $form->text('short', '短标题')->rules('required|string|max:200');
                $form->image('thumb', '缩略图');
                $form->textarea('description', '描述')->rules('required|string|max:250');
                $form->editor('body', '内容')->rules('required|string');

                $types = ['default' => '默认', 'line' => '路线攻略', 'food' => '美食攻略', 'hospital' => '住宿攻略', 'scenic' => '景点攻略'];
                $form->radio('type', '类别')->options($types)->default('default');

                $form->multipleSelect('navs', '关联导航')->options(Nav::pluck('text', 'id'));
                $form->number('click', '点击量')->rules('required|numeric|min:0')->default(mt_rand(100, 1000))->help('随机数 100-1000');
            })->tab('关联地区', function (Form $form) {
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
            });
        });
    }
}
