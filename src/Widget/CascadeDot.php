<?php

namespace DLP\Widget;

use DLP\DLPField;

/**
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
        $this->addVariables(['height'=>$height]);
        $select = json_encode($this->options, JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_HEX_APOS);
        $selected = json_encode($this->checked);
        $this->script = <<<EOT
new ComponentCascadeDot("{$id}",JSON.parse('{$selected}'),JSON.parse('{$select}'));
EOT;
        return parent::render();
    }
}
