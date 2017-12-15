<?php

namespace App\Admin\Controllers;

use App\Models\Activity;

use App\Models\LocList;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

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

            $grid->id('ID')->sortable();
            $grid->column('title', '标题')->editable();
            $grid->column('short', '短标题')->editable();
            $grid->column('price', '显示价格')->editable();
            $grid->column('all_city', '显示地址')->display(function () {
                return [$this->country->name, $this->province->name, isset($this->city) ? $this->city->name : ''];
            })->label();

            $grid->created_at('创建日期');
            $grid->updated_at('修改日期');
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
                $form->image('thumb', '缩略图')->rules('required');
                $form->multipleImage('photos', '展示图')->removable()->help('3张图片');
                $form->number('price', '显示价格')->rules('required|numeric')->help('产品会显示此价格');
                $form->number('play', '游玩天数')->rules('required|numeric')->help('用于数据筛选');
                $form->embeds('tese', '行程特色', function ($form) {
                    $form->textarea('ts', '简介');
                    $form->multipleImage('photos', '特色图片')->removable()->help('3张图片');
                });
            })->tab('其他信息', function (Form $form) {
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
                    $form->multipleImage('photos', '展示图')->removable()->help('3张图片');
                    $form->textarea('body', '行程内容')->rules('required|string');
                    $form->text('zaocan', '早餐')->rules('required|string')->default('包含');
                    $form->text('wucan', '午餐')->rules('required|string')->default('包含');
                    $form->text('wancan', '晚餐')->rules('required|string')->default('包含');
                    $form->text('zhusu', '住宿')->rules('required|string')->default('包含');
                });
            })->tab('出团安排', function (Form $form) {
                $form->hasMany('tuans', '出团日期', function (Form\NestedForm $form) {
                    $form->dateRange('start_time', 'end_time', '报名日期')->rules('required');
                    $form->number('start_num', '开始人数')->rules('required|numeric')->help('初始显示人数');
                    $form->number('end_num', '截止人数')->rules('required|numeric')->help('可报名人数=截止人数-开始人数');
                    $form->number('price', '购买价格')->rules('required|numeric')->help('每人需要支付的价格');
                });
            });
            $form->display('id', 'ID');
            $form->display('created_at', '创建日期');
            $form->display('updated_at', '修改日期');
        });
    }
}
