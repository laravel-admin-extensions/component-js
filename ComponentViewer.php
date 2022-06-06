<?php

namespace App\Admin\Controllers;

use Encore\Admin\Actions\RowAction;
use Encore\Admin\Admin;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Illuminate\Http\Request;

/**
 * Class ComponentViewer
 * @package App\Admin\Controllers
 */
class ComponentViewer
{
    /**
     * 创建弹窗新增表单-按钮
     * @param Grid\Tools $tools
     */
    public static function makeAddFormAction(Grid\Tools $tools){
        $url = Request::capture()->getPathInfo();
        Admin::script(<<<EOF
            $('.CAForm').click(function(){
                componentForm('{$url}/create');
            });
EOF
        );
        $tools->append(new
        class extends RowAction
        {
            public function render()
            {
                return <<<EOF
<div class="btn-group pull-right grid-create-btn" style="margin-right: 10px">
    <a href='javascript:void(0);' class="btn btn-sm btn-success CAForm" title="新增">
        <i class="fa fa-plus"></i><span class="hidden-xs">&nbsp;&nbsp;新增</span>
    </a>
</div>
EOF;
            }
        });
    }

    /**
     * 创建弹窗修改表单-按钮
     * @param Grid $grid
     */
    public static function makeEditFormAction(Grid &$grid)
    {
        $grid->actions(function ($actions) {
            $actions->disableEdit();
            $url = Request::capture()->getPathInfo();
            Admin::script(<<<EOF
            $('.CEForm').click(function(){
                let url = '{$url}' + '/'+this.getAttribute('data-id') + '/edit';
                componentForm(url,'PUT');
            });
EOF
            );

            $actions->add(new
            class extends RowAction
            {
                public function render()
                {
                    $id = $this->getKey();
                    return "<a href='javascript:void(0);' class='CEForm' data-id='$id'>修改</a>";
                }
            });
        });
    }

    /**
     * 创建弹窗修改表单-按钮
     * 旧版图标模式
     * @param Grid $grid
     */
    public static function _makeEditFormAction(Grid &$grid)
    {
        $grid->actions(function ($actions) {
            $actions->disableEdit();
            $url = Request::capture()->getPathInfo();
            Admin::script(<<<EOF
            $('.CEForm').click(function(){
                let url = '{$url}' + '/'+this.getAttribute('data-id') + '/edit';
                componentForm(url,'PUT');
            });
EOF
            );
            $id = $actions->getKey();
            $actions->append("<a data-id='$id' href='javascript:void(0);' class='CEForm'><i class='fa fa-edit'></i></a>");
        });
    }

    /**
     * 弹窗表单内容生成
     * @param Content $content
     * @return array|string
     * @throws \Throwable
     */
    public static function makeForm(Content $content)
    {
        $items = [
            '_content_' => str_replace('pjax-container', '', $content->build())
        ];
        return view('admin.content', $items)->render();
    }

    public static function result($success=true,$message='OK',$data=[])
    {
        return response()->json([
            'code'=>$success?1:0,
            'data'=>$data,
            'message'=>$message
        ],200)
            ->header('Content-Type','application/json;charset=utf-8')
            ->header('Access-Control-Allow-Origin', '*');
    }
}
