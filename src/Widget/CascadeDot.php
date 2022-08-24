<?php

namespace DLP\Widget;

use DLP\DLPField;

/**
 * 点 - 级联选择器
 * Class CascadeDot
 * @package DLP\Widget
 */
class CascadeDot extends DLPField
{
    protected $view = 'dlp::component';

    public function render()
    {
        $id = $this->formatName($this->id);
        $height = isset($this->attributes['height']) ?  $this->attributes['height'] : '200px';
        $limit = isset($this->attributes['limit']) ? (int)$this->attributes['limit'] : 0;
        $this->addVariables(['height'=>$height]);
        $select = json_encode($this->options, JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_HEX_APOS);
        $selected = json_encode($this->checked);
        $this->script = <<<EOT
new ComponentCascadeDot("{$id}",JSON.parse('{$selected}'),JSON.parse('{$select}'),{$limit});
EOT;
        return parent::render();
    }
}
