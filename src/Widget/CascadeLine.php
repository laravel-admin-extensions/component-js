<?php

namespace DLP\Widget;

use DLP\DLPField;

/**
 * 线 - 级联控制器
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
        $limit = isset($this->attributes['limit']) ? (int)$this->attributes['limit'] : 0;
        $this->addVariables(['height'=>$height]);
        $select = json_encode($this->options, JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_HEX_APOS);
        $xhr = $this->xhr ?? '';
        $this->script = <<<EOT
new ComponentCascadeLine("{$id}",JSON.parse('{$select}'),'{$xhr}',{$limit});
EOT;
        return parent::render();
    }
}
