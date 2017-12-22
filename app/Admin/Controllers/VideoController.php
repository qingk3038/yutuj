<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\Tools\VideoType;
use App\Models\LocList;
use App\Models\Video;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class VideoController extends Controller
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

            $content->header('视频');
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

            $content->header('视频');
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

            $content->header('视频');
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
        return Admin::grid(Video::class, function (Grid $grid) {
            $grid->model()->with('admin', 'country', 'province')->latest()->type(request('type', 'film'));

            $grid->id('ID')->sortable();
            $grid->column('title', '标题')->editable();
            $grid->column('click', '点击数')->sortable()->editable();

            $grid->column('all_city', '显示地址')->display(function () {
                return [$this->country['name'], $this->province['name']];
            })->label();

            $grid->column('closed', '状态')->sortable()->switch([
                'on' => ['value' => 0, 'text' => '上线', 'color' => 'success'],
                'off' => ['value' => 1, 'text' => '下线']
            ]);
            $grid->column('admin.name', '上传者');

            $grid->created_at('创建日期');
            $grid->updated_at('更新日期');

            $grid->filter(function ($filter) {
                $filter->equal('type', '类别')->radio(['film' => '短拍', 'live' => '直播']);
                $filter->between('created_at', '创建时间')->datetime();
                $filter->between('updated_at', '更新时间')->datetime();
            });

            $grid->tools(function ($tools) {
                $tools->append(new VideoType());
            });

            $grid->actions(function ($actions) {
                $a = sprintf('<a href="%s" target="_blank"><i class="fa fa-fw fa-paper-plane"></i></a>', route('www.video.show', $actions->row));
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
        return Admin::form(Video::class, function (Form $form) {

            $form->display('id', 'ID');

            $form->text('title', '标题')->rules('required');
            $form->image('thumb', '预览图')->rules('required');

            $form->radio('type', '类别')->options(['film' => '短拍', 'live' => '直播'])->default('film');
            $form->url('url', '视频地址')->rules('required');

            $form->select('country_id', '国家')->options(
                LocList::country()->pluck('name', 'id')
            )->load('province_id', '/admin/api/province')->rules('required');

            $form->select('province_id', '省份')->options(
                LocList::province()->pluck('name', 'id')
            )->load('city_id', '/admin/api/city')->rules('required');

            $form->textarea('description', '描述')->rules('required|max:200');

            $form->number('click', '点击量')->rules('required|numeric|min:0')->default(mt_rand(100, 1000))->help('随机数 100-1000');
            $form->switch('closed', '状态')->states([
                'on' => ['value' => 0, 'text' => '上线', 'color' => 'success'],
                'off' => ['value' => 1, 'text' => '下线']
            ]);
            $form->display('created_at', '创建日期');
            $form->display('updated_at', '更新日期');

            $form->hidden('admin_user_id')->default(Admin::user()->id);
        });
    }
}
