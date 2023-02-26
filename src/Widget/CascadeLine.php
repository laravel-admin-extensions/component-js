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
        $width = isset($this->attributes['width']) ? $this->attributes['width'] : '100%';
        $height = isset($this->attributes['height']) ? $this->attributes['height'] : '230px';
        $this->addVariables(['width' => $width, 'height' => $height]);
        $list = json_encode($this->list, JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_HEX_APOS);
        $xhr = $this->xhr ?? '';

        $options = json_encode([
            'movable' => isset($this->attributes['movable']) ? (bool)$this->attributes['movable'] : true,
            'exchange' => isset($this->attributes['exchange']) ? (bool)$this->attributes['exchange'] : true,
            'insert' => isset($this->attributes['insert']) ? (bool)$this->attributes['insert'] : true,
            'update' => isset($this->attributes['update']) ? (bool)$this->attributes['update'] : true,
            'delete' => isset($this->attributes['delete']) ? (bool)$this->attributes['delete'] : true,
            'detail' => isset($this->attributes['detail']) ? (bool)$this->attributes['detail'] : true,
        ]);
        $this->script = <<<EOT
new ComponentCascadeLine("{$id}",{$list},'{$xhr}',{$options});
EOT;
        return parent::render();
    }
}
