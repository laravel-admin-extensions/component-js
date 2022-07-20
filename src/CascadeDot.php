<?php

namespace DLP;

use Encore\Admin\Form\Field;

class CascadeDot extends Field
{
    protected $view = 'dlp::component';

    public function render()
    {
        $id = $this->formatName($this->id);
        $height = isset($this->attributes['height']) ?  $this->attributes['height'] : '200px';
        $this->addVariables(['height'=>$height]);
        $select = json_encode($this->options, JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_HEX_APOS);
        $selected = array_map(function ($v) {
            return (int)$v;
        }, array_values($this->checked));
        $selected = json_encode($selected);
        $this->script = <<<EOT
new ComponentCascadeDot("{$id}",JSON.parse('{$selected}'),JSON.parse('{$select}'));
EOT;
        return parent::render();
    }
}
