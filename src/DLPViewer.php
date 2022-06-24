<?php

namespace DLP;

use Encore\Admin\Actions\RowAction;
use Encore\Admin\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Illuminate\Http\Request;

/**
 * Class DLPViewer
 * @package DLP
 */
class DLPViewer
{
    /**
     * 点
     * @param Form $form
     * @param string $column  字段名
     * @param string $title   名称
     * @param array $select   全部选项
     * @param array $selected 已选择选项
     * @param bool $strict    json严格模式 消除json敏感字符问题
     */
    public static function makeComponentDot(Form $form, string $column, string $title, array $select = [], array $selected = [],bool $strict = false)
    {
        if ($strict) {
            $select = DLPHelper::safeJson($select);
            $selected = DLPHelper::safeJson($selected);
        } else {
            $select = json_encode($select, JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_HEX_APOS);
            $selected = json_encode($selected, JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_HEX_APOS);
        }
        Admin::script(<<<EOF
new ComponentDot("{$column}",JSON.parse('{$selected}'),JSON.parse('{$select}'));
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
     * @param bool $strict    json严格模式 消除json敏感字符问题
     */
    public static function makeComponentLine(Form $form, string $column, string $title, array $settings = [], array $data = [], bool $strict = false)
    {
        if($strict) {
            $data = DLPHelper::safeJson($data);
        }else{
            $data = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_HEX_APOS);
        }
        $settings = json_encode($settings, JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_HEX_APOS);
        Admin::script(<<<EOF
new ComponentLine("{$column}",JSON.parse('{$settings}'),JSON.parse('{$data}'));
EOF
        );
        $form->html("<div id='{$column}'></div>", $title);
    }

    /**
     * 头部-多操作添加
     * @param Grid $grid
     * @param array $settings [setting,...]
     *  setting.document_id 自定义节点ID
     *  setting.title 自定义按钮名
     *  setting.url 加载页地址
     *  setting.xhr_url ajax提交地址
     *  setting.method ajax提交方法
     */
    public static function makeHeadPlaneAction(Grid $grid,array $settings = [
        ['document_id'=>'','title'=>'','url'=>'','xhr_url'=>'','method'=>'POST']
    ])
    {
        $script = '';
        foreach ($settings as $setting){
            $xhr_url = isset($setting['xhr_url']) ? $setting['xhr_url'] : $setting['url'];
            $method = isset($setting['method']) ? $setting['method'] : 'POST';
            $script.=<<<EOF
            $('#{$setting['document_id']}').click(function(){
                new ComponentPlane('{$setting['url']}','{$xhr_url}','{$method}');
            });
EOF;
            Admin::script($script);
            $grid->tools->append(new class($setting['title'],$setting['document_id']) extends RowAction {
                private $title;
                private $document_id;
                public function __construct($title,$document_id)
                {
                    parent::__construct();
                    $this->title = $title;
                    $this->document_id = $document_id;
                }
                public function render()
                {
                    return <<<EOF
<div class="btn-group pull-right grid-create-btn" style="margin-right: 10px">
    <a href='javascript:void(0);' class="btn btn-sm btn-primary" id="{$this->document_id}" title="{$this->title}">
        <span class="hidden-xs">{$this->title}</span>
    </a>
</div>
EOF;
                }
            });
        }
    }

    /**
     * 列-多操作添加
     * @param Grid $grid
     * @param array $settings [setting,...]
     *  setting.document_class 自定义类名
     *  setting.title 自定义按钮名
     *  setting.url 加载页地址  url/{id}加参数匹配id
     *  setting.xhr_url ajax提交地址 url/{id}加参数匹配id
     *  setting.method ajax提交方法
     * @param array $disable ['view','edit','delete']
     */
    public static function makeRowPlaneAction(Grid $grid,array $settings = [
        ['document_class'=>'','title'=>'','url'=>'','xhr_url'=>'','method'=>'POST']
    ],array $disable=[])
    {
        $script = '';
        foreach ($settings as $setting){
            $url = $setting['url'];
            $method = isset($setting['method']) ? $setting['method'] : 'POST';
            $xhr_url = isset($setting['xhr_url']) ? $setting['xhr_url'] : $url;
            $script.=<<<EOF
            $('.{$setting['document_class']}').click(function(){
                let url = '$url'.replace('{id}',$(this).attr('data-id'));
                let xhr_url = '$xhr_url'.replace('{id}',$(this).attr('data-id'));
                new ComponentPlane(url,xhr_url,'{$method}');
            });
EOF;
        }
        Admin::script($script);
        $grid->actions(function ($actions)use($settings,$disable) {
            foreach ($settings as $setting) {
                $actions->add(new
                class($setting['document_class'], $setting['title']) extends RowAction {
                    private $title;
                    private $document_class;
                    public function __construct($document_class, $title)
                    {
                        parent::__construct();
                        $this->document_class = $document_class;
                        $this->title = $title;
                    }
                    public function render()
                    {
                        return "<a href='javascript:void(0);' class='{$this->document_class}' data-id='{$this->getKey()}'>{$this->title}</a>";
                    }
                });
            }
            foreach ($disable as $dis){
                $dis == 'view' && $actions->disableView();
                $dis == 'edit' && $actions->disableEdit();
                $dis == 'delete' && $actions->disableDelete();
            }
        });
    }

    /**
     * 列-多操作添加 (旧版图标按钮模式)
     * @param Grid $grid
     * @param array $settings [setting,...]
     *  setting.document_class 自定义类名
     *  setting.title 自定义按钮名 (图标css类 fa-edit fa-...)
     *  setting.url 加载页地址
     *  setting.xhr_url ajax提交地址
     *  setting.method ajax提交方法
     * @param array $disable ['view','edit','delete']
     */
    public static function _makeRowPlaneAction(Grid $grid,array $settings = [
        ['document_class'=>'','title'=>'','url'=>'','xhr_url'=>'','method'=>'POST']
    ],array $disable=[])
    {
        $script = '';
        foreach ($settings as $setting){
            $url = $setting['url'];
            $method = isset($setting['method']) ? $setting['method'] : 'POST';
            $xhr_url = isset($setting['xhr_url']) ? $setting['xhr_url'] : $url;
            $script.=<<<EOF
            $('.{$setting['document_class']}').click(function(){
                let url = '$url'.replace('{id}',$(this).attr('data-id'));
                new ComponentPlane(url,'{$xhr_url}','{$method}');
            });
EOF;
        }
        Admin::script($script);
        $grid->actions(function ($actions)use($settings,$disable) {
            foreach ($settings as $setting) {
                $actions->append("<a data-id='{$actions->getKey()}' href='javascript:void(0);' class='{$setting['document_class']}'><i class='fa {$setting['title']}'></i></a>");
            }
            foreach ($disable as $dis){
                $dis == 'view' && $actions->disableView();
                $dis == 'edit' && $actions->disableEdit();
                $dis == 'delete' && $actions->disableDelete();
            }
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
        return view('dlp::content', [
            '_content_' => str_replace('pjax-container', '', $content->build())
        ])->render();
    }

    /**
     * 弹窗自定义视图生成
     * @param string $html
     * @return array|string
     * @throws \Throwable
     */
    public static function makeHtml($html)
    {
        return view('dlp::content', [
            '_content_' => $html
        ])->render();
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
}