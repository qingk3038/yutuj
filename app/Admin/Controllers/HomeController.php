<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('Dashboard');
            $content->description('Description...');

            $content->row(Dashboard::title());

            $content->row(function (Row $row) {

                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::environment());
                });

                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::extensions());
                });

                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::dependencies());
                });
            });
        });
    }

    public function images(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'files' => 'required',
            'files.*' => 'image',
        ]);

        if ($validator->fails()) {
            return ['errno' => 1, 'message' => $validator->errors()];
        }

        $files = $request->file('files');

        $data = [];
        foreach ($files as $file) {
            $path = $file->store('images', 'admin');
            $data[] = Storage::disk('admin')->url($path);
        }
        return ['errno' => 0, 'data' => $data];
    }
}
