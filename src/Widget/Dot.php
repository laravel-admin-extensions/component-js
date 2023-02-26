<?php

namespace DLP\Widget;

use DLP\DLPField;

/**
 * 点
 * Class Dot
 * @package DLP\Widget
 */
class Dot extends DLPField
{
    protected $view = 'dlp::component';

    public function render()
    {
        $id = $this->formatName($this->id);
        $limit = isset($this->attributes['limit']) ? (int)$this->attributes['limit'] : 0;
        $width = isset($this->attributes['width']) ? $this->attributes['width'] : '100%';
        $height = isset($this->attributes['height']) ? $this->attributes['height'] : '200px';
        $settings = json_encode([
            'mode'=>isset($this->attributes['mode']) && $this->attributes['mode'] === true ? true : false,
            'placeholder'=>isset($this->attributes['placeholder']) ? $this->attributes['placeholder'] : '未选择',
            'height'=>isset($this->attributes['menu_height']) ? $this->attributes['menu_height'] : '150px',
            'useSearch'=>isset($this->attributes['useSearch']) && $this->attributes['useSearch'] === true ? true :false]);
        $this->addVariables(['width' => $width, 'height' => $height]);
        $select = json_encode($this->options, JSON_FORCE_OBJECT | JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_HEX_APOS);
        $selected = json_encode($this->checked);
        $this->script = <<<EOT
new ComponentDot("{$id}",{$select},{$selected},{$limit},{$settings});
EOT;
        return parent::render();
    }
}
