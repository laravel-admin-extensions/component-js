<?php

namespace DLP\Widget\PlaneAction;

use Encore\Admin\Actions\RowAction;
use Encore\Admin\Admin;

/**
 * Class HeadPosAction
 * @package DLP\Widget\PlaneAction
 */
class HeadPosAction extends RowAction
{
    public function __construct($title, $url, $xhr, $options)
    {
        parent::__construct();
        $this->title = $title;
        $callback = isset($xhr['callback']) ? $xhr['callback'] : 'null';
        unset($xhr['callback']);
        $xhr = json_encode($xhr);
        $options = json_encode($options);
        $this->document_id = "button_".substr(md5($this->title.microtime().mt_rand(0,10000)),16);

        $this->binding = ".bindRequest('.box-footer button[type=\"submit\"]','click',XHR)";
        $this->url = $url;
        $this->xhr = $xhr;
        $this->callback = $callback;
        $this->options = $options;
    }

    public function bindEvent($bind)
    {
        $bind = array_merge(['selector'=>'','event'=>'click','params'=>[]],$bind);
        $params = json_encode($bind['params']);
        $this->binding = ".bindEvent('{$bind['selector']}','click',{$bind['event']}, {$params})";
        return $this;
    }

    public function withoutBind()
    {
        $this->binding = '';
        return $this;
    }

    public function render()
    {
        Admin::script(<<<EOF
            $('#{$this->document_id}').click(function(){
                let url = '{$this->url}';
                let XHR = JSON.parse('{$this->xhr}');
                XHR.url = XHR.url !== undefined ? XHR.url : url;
                XHR.callback = {$this->callback};
                new ComponentPlane({url:url},{$this->options}){$this->binding}.setTitle('{$this->title}').make();
            });
EOF
        );
        return <<<EOF
<div class="btn-group pull-right grid-create-btn" style="margin-right: 5px">
    <a href='javascript:void(0);' class="btn btn-sm btn-primary" id="{$this->document_id}" title="{$this->title}">
        <span class="hidden-xs">{$this->title}</span>
    </a>
</div>
EOF;
    }
}
