<?php

namespace DLP\Widget;

use DLP\DLPField;

/**
 * Class CascadeLine
 * @package DLP\Widget
 */
class CascadeLine extends DLPField
{
    protected $view = 'dlp::component';

    public function render()
    {
        $id = $this->formatName($this->id);
        $height = isset($this->attributes['height']) ?  $this->attributes['height'] : '200px';
        $this->addVariables(['height'=>$height]);
        $select = json_encode($this->options, JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_HEX_APOS);
        $xhr = $this->xhr ?? '';
        $this->script = <<<EOT
new ComponentCascadeLine("{$id}",JSON.parse('{$select}'),'{$xhr}');
EOT;
        return parent::render();
    }
}
