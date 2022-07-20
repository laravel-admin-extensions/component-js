<?php

namespace DLP;

use Encore\Admin\Actions\RowAction;
use Encore\Admin\Admin;

class PlaneRowAction extends RowAction
{
    private $title;
    private $document_class;

    public function __construct($title,$url,$xhr_url=null,$method='POST',$callback=null,$options=[])
    {
        parent::__construct();
        $this->title = $title;
        if(!$xhr_url){
            $xhr_url = $url;
        }
        $options = json_encode($options);
        $this->document_class = substr(md5($title.$url),16);
        Admin::script(<<<EOF
            $('.{$this->document_class}').click(function(){
                let url = '$url'.replace('{id}',$(this).attr('data-id'));
                let xhr_url = '$xhr_url'.replace('{id}',$(this).attr('data-id'));
                new ComponentPlane(url,xhr_url,'{$method}','{$callback}',JSON.parse('{$options}'));
            });
EOF
    );
    }

    public function render()
    {
        return "<a href='javascript:void(0);' class='{$this->document_class}' data-id='{$this->getKey()}'>{$this->title}</a>";
    }
}
