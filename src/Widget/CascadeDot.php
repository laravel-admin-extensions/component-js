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
        $limit = isset($this->attributes['limit']) ? (int)$this->attributes['limit'] : 0;
        $width = isset($this->attributes['width']) ? $this->attributes['width'] : '100%';
        $height = isset($this->attributes['height']) ? $this->attributes['height'] : '230px';
        $this->addVariables(['width' => $width, 'height' => $height]);
        $select = json_encode($this->options, JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_HEX_APOS);
        $selected = json_encode($this->checked);
        $this->script = <<<EOT
new ComponentCascadeDot("{$id}",{$select},{$selected},{$limit});
EOT;
        return parent::render();
    }
}
