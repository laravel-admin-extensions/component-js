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
    public function __construct($title,$url,$xhr,$options)
    {
        parent::__construct();
        $this->title = $title;
        $xhr = json_encode($xhr);
        $options = json_encode($options);
        $this->document_id = substr(md5($title.$url),16);
        Admin::script(<<<EOF
            $('#{$this->document_id}').click(function(){
                let url = '{$url}';
                let XHR = JSON.parse('{$xhr}');
                XHR.url = XHR.url !== undefined ? XHR.url : url;
                XHR.element = document.querySelector('#dlp-plane button[type="submit"]');
                XHR.listener = (DOM)=>{DOM.querySelector('button[type="submit"]')};
                new ComponentPlane(url,XHR,JSON.parse('{$options}'));
            });
EOF
        );
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
}
