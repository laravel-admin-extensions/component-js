<?php

namespace DLP;

use Encore\Admin\Actions\RowAction;
use Encore\Admin\Admin;

class PlaneHeadAction extends RowAction
{
    private $title;
    private $document_id;

    public function __construct($title,$url,$xhr_url=null,$method='POST',$callback='null',$options=[])
    {
        parent::__construct();
        $this->title = $title;
        if(!$xhr_url){
            $xhr_url = $url;
        }
        $options = json_encode($options);
        $this->document_id = substr(md5($title.$url),16);
        Admin::script(<<<EOF
            $('#{$this->document_id}').click(function(){
                new ComponentPlane('{$url}','{$xhr_url}','{$method}',{$callback},JSON.parse('{$options}'));
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
