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
     * @param string $column 数据字段名
     * @param string $title 名称
     * @param array $select 全部选项
     * @param array $selected 已选择选项
     * @param array $settings 配置项
     * $settings = [
     *      'strict'=>false,   boolean json严格模式消除json敏感字符问题
     *      'width'=>'100%'    string 容器宽度设置
     *      'height'=>'200px', string 容器高度设置
     * ]
     */
    public static function makeComponentDot(Form $form, string $column, string $title, array $select = [], array $selected = [], array $settings = [])
    {
        $strict = isset($settings['strict']) && $settings['strict'] ? true : false;
        $width = isset($settings['width']) ? $settings['width'] : '100%';
        $hight = isset($settings['height']) ? $settings['height'] : '200px';
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
        $form->html("<div id='{$column}' style='width:{$width};height: {$hight};'></div>", $title);
    }

    /**
     * 线
     * @param Form $form
     * @param string $column 数据字段名
     * @param string $title 名称
     * @param array $data 数据
     * @param array $settings 配置项[setting,...]
     * $settings = [
     *      'columns'=>[
     *          'name' => ['name' => '名称', 'type' => 'input'],
     *          'name1' => ['name1' => '名称1', 'type' => 'text', style=>'width:50px'],
     *          'name2' => ['name2' => '名称2', 'type' => 'hidden'],
     *          ...],               array  多列配置项 (必须填)
     *      'strict'=>false,        boolean json严格模式消除json敏感字符问题 (选填)
     *      'width'=>'100%',        string 容器宽度设置 (选填)
     *      'height'=>'450px',      string 容器高度设置 (选填)
     *      'options'=>[
     *          'sortable'=>true,
     *          'delete'=>true
     *      ]                       array 多列操作设置 (选填)
     * ]
     */
    public static function makeComponentLine(Form $form, string $column, string $title, array $data = [], array $settings = [])
    {
        $strict = isset($settings['strict']) && $settings['strict'] ? true : false;
        $width = isset($settings['width']) ? $settings['width'] : '100%';
        $hight = isset($settings['height']) ? $settings['height'] : '450px';
        $options = isset($settings['options']) ? json_encode($settings['options']) : '[]';
        if (!isset($settings['columns'])) return;
        $columns = $settings['columns'];
        if ($strict) {
            $data = DLPHelper::safeJson($data);
        } else {
            $data = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_HEX_APOS);
        }
        $columns = json_encode($columns, JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_HEX_APOS);
        Admin::script(<<<EOF
new ComponentLine("{$column}",JSON.parse('{$columns}'),JSON.parse('{$data}'),JSON.parse('{$options}'));
EOF
        );
        $form->html("<div id='{$column}' style='width:{$width};height:{$hight};'></div>", $title);
    }

    /**
     * 头部-多操作添加
     * @param Grid $grid
     * @param array $settings 配置项[setting,...]
     *  settings.document_id    dom节点id      (必须填)
     *  settings.title          自定义按钮名   (必须填)
     *  settings.url            加载页地址  url/{id}加参数匹配id (必须填)
     *  settings.xhr_url        ajax提交地址 url/{id}加参数匹配id (选填)
     *  settings.method         ajax提交方法 (选填)
     *  settings.options        弹窗配置项 (选填)
     *           options = ['W'=>0.8,'H'=>0.8]
     */
    public static function makeHeadPlaneAction(Grid $grid, array $settings = [
        ['document_id' => '', 'title' => '', 'url' => '', 'xhr_url' => '', 'method' => 'POST', 'options' => []]
    ])
    {
        $script = '';
        foreach ($settings as $setting) {
            $xhr_url = isset($setting['xhr_url']) ? $setting['xhr_url'] : $setting['url'];
            $method = isset($setting['method']) ? $setting['method'] : 'POST';
            $options = isset($setting['options']) ? json_encode($setting['options']) : '[]';
            $script .= <<<EOF
            $('#{$setting['document_id']}').click(function(){
                new ComponentPlane('{$setting['url']}','{$xhr_url}','{$method}',null,JSON.parse('{$options}'));
            });
EOF;
            Admin::script($script);
            $grid->tools->append(new class($setting['title'], $setting['document_id']) extends RowAction {
                private $title;
                private $document_id;

                public function __construct($title, $document_id)
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
     *  setting.document_class dom节点classname (必须填)
     *  setting.title          自定义按钮名 (必须填)
     *  setting.url            加载页地址  url/{id}加参数匹配id (必须填)
     *  setting.xhr_url        ajax提交地址 url/{id}加参数匹配id (选填)
     *  setting.method         ajax提交方法 (选填)
     *  setting.options        弹窗配置项 (选填)
     *           options = ['W'=>0.8,'H'=>0.8]
     * @param array $disable ['view','edit','delete']
     */
    public static function makeRowPlaneAction(Grid $grid, array $settings = [
        ['document_class' => '', 'title' => '', 'url' => '', 'xhr_url' => '', 'method' => 'POST', 'options' => []]
    ], array $disable = [])
    {
        $script = '';
        foreach ($settings as $setting) {
            $url = $setting['url'];
            $method = isset($setting['method']) ? $setting['method'] : 'POST';
            $xhr_url = isset($setting['xhr_url']) ? $setting['xhr_url'] : $url;
            $options = isset($setting['options']) ? json_encode($setting['options']) : '[]';
            $script .= <<<EOF
            $('.{$setting['document_class']}').click(function(){
                let url = '$url'.replace('{id}',$(this).attr('data-id'));
                let xhr_url = '$xhr_url'.replace('{id}',$(this).attr('data-id'));
                new ComponentPlane(url,xhr_url,'{$method}',null,JSON.parse('{$options}'));
            });
EOF;
        }
        Admin::script($script);
        $grid->actions(function ($actions) use ($settings, $disable) {
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
            foreach ($disable as $dis) {
                $dis == 'view' && $actions->disableView();
                $dis == 'edit' && $actions->disableEdit();
                $dis == 'delete' && $actions->disableDelete();
            }
        });
    }

    /**
     * 列-多操作添加  (旧版图标按钮模式)
     * @param Grid $grid
     * @param array $settings [setting,...]
     *  setting.document_class dom节点classname (必须填)
     *  setting.title          自定义按钮名 (必须填)
     *  setting.url            加载页地址  url/{id}加参数匹配id (必须填)
     *  setting.xhr_url        ajax提交地址 url/{id}加参数匹配id (选填)
     *  setting.method         ajax提交方法 (选填)
     *  setting.options        弹窗配置项 (选填)
     *           options = ['W'=>0.8,'H'=>0.8]
     * @param array $disable ['view','edit','delete']
     */
    public static function _makeRowPlaneAction(Grid $grid, array $settings = [
        ['document_class' => '', 'title' => '', 'url' => '', 'xhr_url' => '', 'method' => 'POST', 'options' => []]
    ], array $disable = [])
    {
        $script = '';
        foreach ($settings as $setting) {
            $url = $setting['url'];
            $method = isset($setting['method']) ? $setting['method'] : 'POST';
            $xhr_url = isset($setting['xhr_url']) ? $setting['xhr_url'] : $url;
            $options = isset($setting['options']) ? json_encode($setting['options']) : '[]';
            $script .= <<<EOF
            $('.{$setting['document_class']}').click(function(){
                let url = '$url'.replace('{id}',$(this).attr('data-id'));
                let xhr_url = '$xhr_url'.replace('{id}',$(this).attr('data-id'));
                new ComponentPlane(url,xhr_url,'{$method}',null,JSON.parse('{$options}'));
            });
EOF;
        }
        Admin::script($script);
        $grid->actions(function ($actions) use ($settings, $disable) {
            foreach ($settings as $setting) {
                $actions->append("<a data-id='{$actions->getKey()}' href='javascript:void(0);' class='{$setting['document_class']}'><i class='fa {$setting['title']}'></i></a>");
            }
            foreach ($disable as $dis) {
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