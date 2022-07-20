<?php

namespace DLP;

use Encore\Admin\Form\Field;

class Linear extends Field
{
    protected $view = 'dlp::component';

    public function render()
    {
        $id = $this->formatName($this->id);
        if(isset($this->attributes['columns'])){
            $columns = json_encode($this->attributes['columns']);
        }else{
            $columns = [];
            foreach (array_keys(current($this->options)) as $key){
                $columns[$key] = ['name'=>$key,'type' => 'text'];
            }
            $columns = json_encode($columns);
        }
        $this->attributes['columns'] = null;
        $options = isset($this->attributes['options']) ?  json_encode($this->attributes['options']) : json_encode(['sortable'=>true,'delete'=>true]);
        $height = isset($this->attributes['height']) ?  $this->attributes['height'] : '360px';
        $this->addVariables(['height'=>$height]);
        $data = json_encode($this->options, JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_HEX_APOS);
        $this->script = <<<EOT
new ComponentLine("{$id}",JSON.parse('{$columns}'),JSON.parse('{$data}'),JSON.parse('{$options}'));
EOT;
        return parent::render();
    }
}
