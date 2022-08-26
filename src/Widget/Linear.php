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
            $columns = json_encode($this->columns);
        } else {
            $columns = [];
            $record = current($this->options);
            if (!is_array($record) || empty($record)) {
                return;
            }
            foreach (array_keys($record) as $key) {
                $columns[$key] = ['name' => $key, 'type' => 'text'];
            }
            $columns = json_encode($columns);
        }
        $options = isset($this->attributes['options']) ? json_encode($this->attributes['options']) : json_encode(['sortable' => true, 'delete' => true]);
        $height = isset($this->attributes['height']) ? $this->attributes['height'] : '355px';
        $this->addVariables(['height' => $height]);
        $data = json_encode($this->options, JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_HEX_APOS);
        $this->script = <<<EOT
new ComponentLine("{$id}",JSON.parse('{$columns}'),JSON.parse('{$data}'),JSON.parse('{$options}'));
EOT;
        return parent::render();
    }
}
