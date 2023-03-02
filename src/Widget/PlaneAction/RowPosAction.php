<?php

namespace DLP\Widget\PlaneAction;

use Encore\Admin\Actions\RowAction;
use Encore\Admin\Admin;

/**
 * Class RowPosAction
 * @package DLP\Widget\PlaneAction
 */
class RowPosAction extends RowAction
{
    public function __construct($title, $url, $xhr, $options, $bind)
    {
        parent::__construct();
        $this->title = $title;
        $callback = isset($xhr['callback']) ? $xhr['callback'] : 'null';
        unset($xhr['callback']);
        $xhr = json_encode($xhr);
        $options = json_encode($options);
        $this->document_class = substr(md5($title . $url), 16);

        $binding = '';
        $bind = array_merge(['selector'=>'submit','event'=>'null','params'=>'{}'],$bind);
        $bind['params'] = json_encode($bind['params']);
        if($bind['selector'] == 'submit'){
            $binding = ".bindRequest('button[type=\"submit\"]','click','request',XHR)";
        }else if($bind['event'] == 'request'){
            $binding = ".bindRequest('{$bind['selector']}','click','request',XHR)";
        }else{
            $binding = ".bindEvent('{$bind['selector']}','click',{$bind['event']}, {$bind['params']})";
        }

        Admin::script(<<<EOF
            $('.{$this->document_class}').click(function(){
                let url = '{$url}';
                let XHR = JSON.parse('{$xhr}');
                XHR.url = XHR.url !== undefined ? XHR.url : url;
                XHR.callback = {$callback};
                new ComponentPlane({url:url},{$options}){$binding}.make();
            });
EOF
        );
    }

    public function render()
    {
        return "<a href='javascript:void(0);' class='{$this->document_class}'>{$this->title}</a>";
    }
}
