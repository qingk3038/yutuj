<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\Tools\NavTools;
use App\Models\Activity;

use App\Models\LocList;
use App\Models\Nav;
use App\Models\Tag;
use App\Models\Type;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Support\MessageBag;

class ActivityController extends Controller
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

            $content->header('活动');
            $content->description('index');

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

            $content->header('活动');
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

            $content->header('活动');
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
        return Admin::grid(Activity::class, function (Grid $grid) {
            $grid->model()->with('admin', 'types', 'tags', 'navs');

            $grid->id('ID')->sortable();
            $grid->column('title', '标题')->editable();
            $grid->column('price', '显示价格')->sortable()->editable();
            $grid->column('play', '游玩天数')->sortable()->badge();
            $grid->types('类别')->pluck('text')->badge();
            $grid->tags('标签')->pluck('text')->badge();
            $grid->column('cfd', '出发地')->badge();
            $grid->column('admin.username', '作者');
            $grid->updated_at('修改日期');

            $grid->filter(function ($filter) {
                $filter->in('navs.id', '导航')->multipleSelect(Nav::pluck('text', 'id'));
                $filter->between('created_at', '创建时间')->datetime();
                $filter->between('updated_at', '更新时间')->datetime();
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
        return Admin::form(Activity::class, function (Form $form) {

            $form->tab('基本信息', function (Form $form) {
                $form->text('title', '标题')->rules('required|string|max:200');
                $form->text('short', '短标题')->rules('required|string|max:200');
                $form->text('cfd', '出发地点')->rules('required|string|max:50')->default('四川-成都');
                $form->number('price', '显示价格')->rules('required')->help('产品会显示此价格')->default(5000);
                $form->textarea('description', '产品描述')->rules('required|string|max:350');
                $form->text('xc', '行程描述')->rules('required|string|max:200');

                $form->image('thumb', '缩略图');
                $form->multipleImage('photos', '展示图')->removable()->help('3张图片');
                $form->textarea('ts', '行程特色简介');
                $form->multipleImage('tps', '行程特色图片')->removable()->help('3张图片');
            })->tab('注意事项', function (Form $form) {
                $form->textarea('baohan', '费用包含');
                $form->textarea('buhan', '费用不含');
                $form->textarea('zhuyi', '注意事项');
                $form->textarea('qianyue', '签约条款');
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
            })->tab('行程安排', function (Form $form) {
                $form->hasMany('trips', '行程', function (Form\NestedForm $form) {
                    $form->text('title', '行程标题')->rules('required|string');
                    $form->multipleFile('pictures', '展示图')->removable()->help('3张图片');
                    $form->textarea('body', '行程内容')->rules('required|string');
                    $form->text('zaocan', '早餐')->rules('required|string')->default('包含');
                    $form->text('wucan', '午餐')->rules('required|string')->default('包含');
                    $form->text('wancan', '晚餐')->rules('required|string')->default('包含');
                    $form->text('zhusu', '住宿')->rules('required|string')->default('包含');
                });
            })->tab('出团安排', function (Form $form) {
                $form->hasMany('tuans', '出团日期', function (Form\NestedForm $form) {
                    $form->dateRange('start_time', 'end_time', '报名日期')->rules('required');
                    $form->number('start_num', '开始人数')->rules('required')->help('初始显示人数');
                    $form->number('end_num', '截止人数')->rules('required')->help('可报名人数=截止人数-开始人数');
                    $form->number('price', '购买价格')->rules('required')->help('每人需要支付的价格');
                });
            })->tab('导航与标签', function (Form $form) {
                $form->multipleSelect('navs', '导航')->options(Nav::pluck('text', 'id'))->rules('required');
                $form->multipleSelect('types', '类别')->options(Type::pluck('text', 'id'));
                $form->multipleSelect('tags', '标签')->options(Tag::pluck('text', 'id'));
            });

            $form->saving(function (Form $form) {
                $form->model()->play = count($form->trips);
                $form->model()->admin_user_id = Admin::user()->id;
            });
        });
    }

}
