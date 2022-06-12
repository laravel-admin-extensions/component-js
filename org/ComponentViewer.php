<?php

namespace App\Admin\Extensions;

use Encore\Admin\Actions\RowAction;
use Encore\Admin\Admin;
use Encore\Admin\Form;
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
     * 点
     * @param Form $form
     * @param string $column  字段名
     * @param string $title   名称
     * @param array $select   全部选项
     * @param array $selected 已选择选项
     * @param bool $strict    json严格模式
     */
    public static function makeComponentDot(Form $form, string $column, string $title, array $select = [], array $selected = [],bool $strict = true)
    {
        if ($strict) {
            $select = self::safeJson($select);
            $selected = self::safeJson($selected);
        } else {
            $select = json_encode($select, JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS);
            $selected = json_encode($selected, JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS);
        }
        self::script(<<<EOF
componentDot("{$column}",JSON.parse('$selected'),JSON.parse('$select'));
EOF
        );
        $form->html("<div id='{$column}'></div>", $title);
    }

    /**
     * 线
     * @param Form $form
     * @param string $column  字段名
     * @param string $title   名称
     * @param array $settings  设置项
     * @param array $data     数据
     * @param bool $strict    json严格模式
     */
    public static function makeComponentLine(Form $form, string $column, string $title, array $settings = [], array $data = [], bool $strict = true)
    {
        if($strict) {
            $data = self::safeJson($data);
        }else{
            $data = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS);
        }
        $data = self::safeJson($data);
        self::script(<<<EOF
componentLine("{$column}",JSON.parse('$settings'),JSON.parse('$data'));
EOF
        );
        $form->html("<div id='{$column}'></div>", $title);
    }

    /**
     * 创建弹窗页-按钮
     * @param Grid $grid
     */
    public static function makePlaneAction(Grid $grid,$class='')
    {
        $url = Request::capture()->getPathInfo();
        Admin::script(<<<EOF
            $('.{$class}').click(function(){
                componentPlane('{$url}/create');
            });
EOF
        );
        $grid->disableCreateButton();
        $grid->tools->append(new
        class extends RowAction {
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
     * 创建弹窗新增表单-按钮
     * @param Grid $grid
     */
    public static function makeAddFormAction(Grid $grid)
    {
        $url = Request::capture()->getPathInfo();
        Admin::script(<<<EOF
            $('.CAForm').click(function(){
                componentPlane('{$url}/create');
            });
EOF
        );
        $grid->disableCreateButton();
        $grid->tools->append(new
        class extends RowAction {
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
    public static function makeEditFormAction(Grid $grid)
    {
        $grid->actions(function ($actions) {
            $actions->disableEdit();
            $url = Request::capture()->getPathInfo();
            Admin::script(<<<EOF
            $('.CEForm').click(function(){
                let url = '{$url}' + '/'+this.getAttribute('data-id') + '/edit';
                componentPlane(url);
            });
EOF
            );

            $actions->add(new
            class extends RowAction {
                public function render()
                {
                    $id = $this->getKey();
                    return "<a href='javascript:void(0);' class='CEForm' data-id='$id'>修改</a>";
                }
            });
        });
    }

    /**
     * 创建弹窗修改表单-按钮  (旧版图标模式)
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
                componentPlane(url);
            });
EOF
            );
            $id = $actions->getKey();
            $actions->append("<a data-id='$id' href='javascript:void(0);' class='CEForm'><i class='fa fa-edit'></i></a>");
        });
    }

    /**
     * 弹窗表单视图生成
     * @param Content $content
     * @return array|string
     * @throws \Throwable
     */
    public static function makeForm(Content $content)
    {
        $items = [
            '_content_' => str_replace('pjax-container', '', $content->build())
        ];
        return view('component.content', $items)->render();
    }

    /**
     * 表单提交ajax返回数据格式
     * @param bool $success
     * @param string $message
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public static function result($success = true, $message = 'OK', $data = [])
    {
        return response()->json([
            'code' => $success ? 0 : 1,
            'data' => $data,
            'message' => $message
        ], 200)
            ->header('Content-Type', 'application/json;charset=utf-8')
            ->header('Access-Control-Allow-Origin', '*');
    }

    /**
     * 表单代码段插入js片段代码
     * @param $script
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public static function script($script)
    {
        return Admin::script(<<<EOF
new Promise((resolve, reject) => {
    while (true){
        if(document.getElementById('component') instanceof HTMLElement){
            return resolve();
        }
    }
}).then(function() {
    {$script}
});
EOF
        );
    }

    protected static function safeJson(array $data)
    {
        self::recursiveJsonArray($data);
        return strip_tags(json_encode($data, JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS));
    }

    private static function recursiveJsonArray(array &$data)
    {
        foreach ($data as &$d) {
            if (is_array($d)) {
                self::recursiveJsonArray($d);
            } else {
                $d = str_replace(['"', '\'', ':', '\\', '/', '{', '}', '[', ']'], '', $d);
            }
        }
    }
}
