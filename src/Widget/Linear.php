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

    /**
     * 直接调用Linear组件
     * @param string $name 名称
     * @param array $columns [column...] 列数据格式配置
     *  column.name             列表头名称
     *  column.type             列数据 输出格式input,text,hidden,datetime,select,image,file
     *  column.insert_type      增加列格式(默认不填同input) 格式input,datetime,select,image,file hidden表示置空
     *  column.style            自定义style格式
     *  column.options          insert_type或type为select时 多选项
     *  column.options_limit    insert_type或type为select时 多选项选择限制数 数字类型默认0:无限制
     *  column.config           insert_type或type为datetime时 配置参考flatpickr官方文档
     * @param array $list 数据集 二维数据集列表格式
     * @param array $style 组件样式设置 宽:width 高:height
     * @param array $options 操作列设置
     *      options.sortable      bool 可排序 true开启
     *      options.delete        bool 可删除 true开启
     *      options.insert        bool 可新增 true开启
     * @return string
     */
    public static function panel($name, array $columns, array $list, array $style = [], array $options = [])
    {
        $columns = json_encode($columns, JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_HEX_APOS | JSON_FORCE_OBJECT);
        $list = json_encode($list, JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_HEX_APOS);
        $style = array_merge(['width' => '100%', 'height' => '355px'], $style);
        $style_string = '';
        foreach ($style as $k => $s) {
            $style_string .= "$k:$s;";
        }
        $options = json_encode(array_merge(['sortable' => true, 'delete' => true, 'insert' => true], $options));

        return <<<EOF
<div id="{$name}" style="$style_string"></div><script>new ComponentLine("{$name}",{$columns},{$list},{$options});</script>
EOF;
    }
}
