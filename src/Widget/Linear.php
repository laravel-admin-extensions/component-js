<?php

namespace DLP\Widget;

use DLP\DLPField;

/**
 * 线
 * Class Linear
 * @package DLP\Widget
 */
class Linear extends DLPField
{
    protected $view = 'dlp::component';

    public function render()
    {
        $id = $this->formatName($this->id);
        if (isset($this->columns)) {
            $columns = json_encode($this->columns, JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_HEX_APOS | JSON_FORCE_OBJECT);
        } else {
            $columns = [];
            $record = current($this->list);
            if (!is_array($record) || empty($record)) {
                return;
            }
            foreach (array_keys($record) as $key) {
                $columns[$key] = ['name' => $key, 'type' => 'text'];
            }
            $columns = json_encode($columns);
        }
        $options = json_encode([
            'sortable' => isset($this->attributes['sortable']) ? (bool)$this->attributes['sortable'] : true,
            'delete' => isset($this->attributes['delete']) ? (bool)$this->attributes['delete'] : true,
            'insert' => isset($this->attributes['insert']) ? (bool)$this->attributes['insert'] : true,
        ]);
        $width = isset($this->attributes['width']) ? $this->attributes['width'] : '100%';
        $height = isset($this->attributes['height']) ? $this->attributes['height'] : '355px';
        $this->addVariables(['width' => $width, 'height' => $height]);
        $list = json_encode($this->list, JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_HEX_APOS);
        $this->script = <<<EOT
new ComponentLine("{$id}",{$columns},{$list},{$options});
EOT;
        return parent::render();
    }
}
