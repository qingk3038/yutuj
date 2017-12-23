<?php

namespace App\Admin\Controllers;

use App\Models\Order;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class OrderController extends Controller
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

            $content->header('订单');
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

            $content->header('订单');
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

            $content->header('订单');
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
        return Admin::grid(Order::class, function (Grid $grid) {
            $grid->model()->with('user');

            $grid->id('ID')->sortable();
            $grid->column('type', '支付类别')->sortable()->display(function ($type) {
                return $type === 'wechat' ? '微信' : '支付宝';
            })->badge();

            $grid->column('status', '状态')->sortable()->badge();

            $grid->column('users', '报名人信息');
            $grid->column('remarks', '报名备注');
            $grid->column('total_fee', '支付金额')->sortable()->display(function ($total_fee) {
                return number_format($total_fee * 100, 2);
            });

            $grid->column('user.name', '支付者')->sortable();
            $grid->pay_at('支付日期');
            $grid->created_at('创建日期');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Order::class, function (Form $form) {

            $form->display('id', 'ID');

            $form->display('created_at', '创建日期');
            $form->display('updated_at', '修改日期');
        });
    }
}
