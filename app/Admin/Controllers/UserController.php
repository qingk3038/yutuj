<?php

namespace App\Admin\Controllers;

use App\User;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class UserController extends Controller
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

            $content->header('注册会员');
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

            $content->header('注册会员');
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

            $content->header('注册会员');
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
        return Admin::grid(User::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->avatar('头像')->image(60, 60);
            $grid->name('昵称')->sortable()->editable();
            $grid->mobile('手机号')->sortable()->editable();
            $grid->sex('性别')->display(function ($sex) {
                return $sex === 'F' ? '女' : '男';
            })->badge();
            $grid->disable('登陆状态')->sortable()->switch([
                'on' => ['value' => 0, 'text' => '正常', 'color' => 'success'],
                'off' => ['value' => 1, 'text' => '禁止'],
            ]);
            $grid->birthday('出生日期')->sortable()->editable('date');
            $grid->column('full', '省份/城市')->display(function ($text) {
                return [$this->province, $this->city];
            })->label();

            $grid->created_at('注册日期')->sortable();
            $grid->updated_at('更新日期')->sortable();

            $grid->filter(function ($filter) {
                $filter->like('name', '昵称');
                $filter->like('mobile', '手机号');
                $filter->between('created_at', '注册日期')->date();
            });

            $grid->actions(function ($actions) {
                $a = sprintf('<a href="%s" target="_blank"><i class="fa fa-fw fa-paper-plane"></i></a>', route('user.travel', $actions->row));
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
        return Admin::form(User::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->image('avatar', '头像')->rules('required')->uniqueName();
            $form->text('name', '昵称')->rules('required|string');
            $form->mobile('mobile', '绑定手机号')->rules(function ($form) {
                $rules = 'required|string|unique:users';
                if ($id = $form->model()->id) {
                    $rules .= ',mobile,' . $id;
                }
                return $rules;
            });
            $form->switch('sex', '性别')->states([
                'on' => ['value' => 'F', 'text' => '女性', 'color' => 'warning'],
                'off' => ['value' => 'M', 'text' => '男性', 'color' => 'success'],
            ])->default('F')->rules('required|string');
            $form->switch('disable', '登陆')->states([
                'on' => ['value' => 0, 'text' => '正常', 'color' => 'success'],
                'off' => ['value' => 1, 'text' => '禁止'],
            ])->default(0);

            $form->date('birthday', '出生日期');
            $form->text('province', '居住省份');
            $form->text('city', '居住城市');
            $form->textarea('description', '个人简介');
            $form->display('created_at', '注册日期');
            $form->display('updated_at', '更新日期');
        });
    }
}
