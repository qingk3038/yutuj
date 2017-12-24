<?php

namespace App\Admin\Controllers;

use App\Models\Order;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Widgets\Table;

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
            $grid->model()->with('author', 'baomings')->latest();

            $grid->id('ID')->sortable();
            $grid->column('type', '支付类别')->sortable()->display(function ($type) {
                return $type === 'wechat' ? '微信' : '支付宝';
            });

            $grid->column('total_fee', '支付金额（元）')->sortable()->display(function ($total_fee) {
                return number_format($total_fee / 100, 2);
            });

            $grid->column('expand', '报名信息')->expand(function () {
                $headers = ['姓名', '手机号', '证件类型', '证件号码', '紧急联系人', '紧急联系手机号'];
                $rows = collect($this->baomings)->map(function ($item, $key) {
                    return array_only($item, ['name', 'mobile', 'cardType', 'cardID', 'nameJ', 'mobileJ']);
                })->toArray();
                return new Table($headers, $rows);
            }, '报名信息');

            $grid->column('remarks', '报名备注');

            $grid->column('transaction_id', '交易号')->sortable();
            $grid->pay_at('支付日期')->sortable();
            $grid->column('status', '状态')->sortable()->display(function () {
                return $this->statusTest();
            });
            $grid->column('author.name', '订单创建')->sortable();

            $grid->disableCreation();
            $grid->filter(function ($filter) {
                $filter->equal('type', '支付类别')->radio(['' => '所有', 'wechat' => '微信', 'alipay' => '支付宝']);
                $filter->between('total_fee', '支付金额');
                $filter->equal('transaction_id', '交易号');
                $filter->between('pay_at', '支付日期')->datetime();
                $filter->between('created_at', '创建日期')->datetime();
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
        return Admin::form(Order::class, function (Form $form) {

            $form->display('id', 'ID');

            $form->display('created_at', '创建日期');
            $form->display('updated_at', '修改日期');
        });
    }
}
