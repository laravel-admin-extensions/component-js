<?php

namespace App\Admin\Controllers;

use Encore\Admin\Admin;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Illuminate\Http\Request;

class ComponentViewer
{
    public static function makeEditFormAction(Grid &$grid)
    {
        $grid->actions(function ($actions) {
            $actions->disableEdit();
            $url = Request::capture()->getPathInfo();
            Admin::script(<<<EOF
        componentEditForm.apply('CEForm','{$url}');
EOF
            );
            $id = $actions->getKey();
            $actions->append("<a data-id='$id' href='javascript:void(0);' class='CEForm'><i class='fa fa-edit'></i></a>");
        });
    }

    public static function makeForm(Content $content)
    {
        $items = [
            '_content_' => str_replace('pjax-container', '', $content->build())
        ];
        return view('admin.content', $items)->render();
    }
}
