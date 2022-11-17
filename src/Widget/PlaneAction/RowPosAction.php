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
    public function __construct($title,$url,$xhr,$options)
    {
        parent::__construct();
        $this->title = $title;
        $callback = isset($xhr['callback']) ? $xhr['callback'] : 'null';
        unset($xhr['callback']);
        $xhr = json_encode($xhr);
        $options = json_encode($options);
        $this->document_class = substr(md5($title.$url),16);
        Admin::script(<<<EOF
            $('.{$this->document_class}').click(function(){
                let url = '{$url}'.replace('{id}',$(this).attr('data-id'));
                let XHR = JSON.parse('{$xhr}');
                XHR.callback = {$callback};
                let xhr_url = XHR.url !== undefined ? XHR.url : url;
                XHR.url = xhr_url.replace('{id}',$(this).attr('data-id'));
                XHR.listener = (DOM)=>DOM.querySelector('.box-footer button[type="submit"]');
                new ComponentPlane(url,XHR,{$options});
            });
EOF
    );
    }

    public function render()
    {
        return "<a href='javascript:void(0);' class='{$this->document_class}' data-id='{$this->getKey()}'>{$this->title}</a>";
    }
}
