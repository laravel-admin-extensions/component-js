<?php

namespace DLP\Component;

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
     * @param $column
     * @param $title
     * @param array $select
     * @param array $selected
     */
    public static function makeComponentDot(Form $form,$column,$title,$select=[],$selected=[])
    {
        $select =self::safeJson($select);
        $selected=self::safeJson($selected);
        $form->html(<<<EOF
<div id="{$column}"></div>
<script>
new Promise((resolve, reject) => {
    while (true){
        if(document.getElementById('{$column}') instanceof HTMLElement){
            return resolve();
        }
    }
}).then(function() {
   componentDot("{$column}",JSON.parse('$selected'),JSON.parse('$select'));
});
</script>
EOF
            ,$title);
    }

    /**
     * @param Form $form
     * @param $column
     * @param $title
     * @param $setting
     * @param array $data
     */
    public static function makeComponentLine(Form $form,$column,$title,array $setting,array $data=[])
    {
        $setting = self::safeJson($setting);
        $data = self::safeJson($data);
        $form->html(<<<EOF
<div id="{$column}"></div>
<script>
new Promise((resolve, reject) => {
    while (true){
        if(document.getElementById('{$column}') instanceof HTMLElement){
            return resolve();
        }
    }
}).then(function() {
    componentLine("{$column}",JSON.parse('$setting'),JSON.parse('$data'));
});
</script>
EOF
            ,$title);
    }

    /**
     * 创建弹窗新增表单-按钮
     * @param Grid $grid
     */
    public static function makeAddFormAction(Grid $grid){
        $url = Request::capture()->getPathInfo();
        Admin::script(<<<EOF
            $('.CAForm').click(function(){
                componentPlane('{$url}/create');
            });
EOF
        );
        $grid->disableCreateButton();
        $grid->tools->append(new
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
                componentPlane(url);
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
        return view('component::content', $items)->render();
    }

    public static function result($success=true,$message='OK',$data=[])
    {
        return response()->json([
            'code'=>$success?0:1,
            'data'=>$data,
            'message'=>$message
        ],200)
            ->header('Content-Type','application/json;charset=utf-8')
            ->header('Access-Control-Allow-Origin', '*');
    }

    private static function safeJson(array $data)
    {
        return strip_tags(json_encode($data,JSON_UNESCAPED_UNICODE|JSON_HEX_QUOT|JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_APOS));
    }
}
