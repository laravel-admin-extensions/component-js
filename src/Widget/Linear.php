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

    /**
     * 直接调用Linear组件
     * @param array $columns    头部字段样式定义
     * @param array $data       数据集
     * @param array $options    操作列设置
     *      options.sortable      bool 可排序
     *      options.delete        bool 可删除
     * @return string
     */
    public static function panel(array $columns,array $data,array $options=['sortable' => true, 'delete' => true])
    {
        $columns = json_encode($columns, JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_HEX_APOS);
        $data = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_HEX_APOS);
        $options = json_encode(array_merge(['sortable' => true, 'delete' => true],$options));
        $id = 'linear_'.mt_rand(0,100);
        return <<<EOF
<div id="{$id}" style="$style_string"></div>
<script>
new ComponentLine("{$id}",JSON.parse('{$columns}'),JSON.parse('{$data}'),JSON.parse('{$options}'));
</script>
EOF;
    }
}
