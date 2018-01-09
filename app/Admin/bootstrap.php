<?php

use App\Admin\Extensions\Column\ExpandRow;
use App\Admin\Extensions\WangEditor;
use Encore\Admin\Form;
use Encore\Admin\Grid\Column;

Form::forget('editor');
Form::extend('editor', WangEditor::class);

Column::extend('expand', ExpandRow::class);

app('view')->prependNamespace('admin', resource_path('views/admin'));