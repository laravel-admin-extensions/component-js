<?php

namespace App\Admin\Controllers;

use Encore\Admin\Actions\RowAction;
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
            componentForm.make = function () {
                componentForm._clear();
                componentForm._createModal();
                let url = componentForm.url + '/'+this.getAttribute('data-id') + '/edit';
                componentForm._createBox(url);
            }
            componentForm.apply('CEForm','{$url}');
EOF
            );

            $actions->add(new
            class extends RowAction
            {
                public $name = '修改';

                public function render()
                {
                    $id = $this->getKey();
                    return "<a href='javascript:void(0);' class='CEForm' data-id='$id', class=>{$this->name()}</a>";
                }
            });
        });
    }

    /**
     * 旧版图标模式
     * @param Grid $grid
     */
    public static function _makeEditFormAction(Grid &$grid)
    {
        $grid->actions(function ($actions) {
            $actions->disableEdit();
            $url = Request::capture()->getPathInfo();
            Admin::script(<<<EOF
            componentForm.make = function () {
                componentForm._clear();
                componentForm._createModal();
                let url = componentForm.url + '/'+this.getAttribute('data-id') + '/edit';
                componentForm._createBox(url);
            }
            componentForm.apply('CEForm','{$url}');
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
