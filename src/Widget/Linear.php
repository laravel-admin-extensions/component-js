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
            $record = current($this->options);
            if (!is_array($record) || empty($record)) {
                return;
            }
            foreach (array_keys($record) as $key) {
                $columns[$key] = ['name' => $key, 'type' => 'text'];
            }
            $columns = json_encode($columns);
        }
        $options = isset($this->attributes['options']) ? json_encode($this->attributes['options']) : json_encode(['sortable' => true, 'delete' => true, 'insert' => true]);
        $width = isset($this->attributes['width']) ? $this->attributes['width'] : '100%';
        $height = isset($this->attributes['height']) ? $this->attributes['height'] : '355px';
        $this->addVariables(['width'=>$width,'height' => $height]);
        $data = json_encode($this->options, JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_HEX_APOS);
        $this->script = <<<EOT
new ComponentLine("{$id}",JSON.parse('{$columns}'),JSON.parse('{$data}'),JSON.parse('{$options}'));
EOT;
        return parent::render();
    }

    /**
     * 直接调用Linear组件
     * @param string $name      名称
     * @param array $columns[column...] 列数据格式配置
              *  column.name             列表头名称
              *  column.type             列数据 输出格式input,text,hidden,datetime,select,image,file
              *  column.insert_type      增加列格式(默认不填同input) 格式input,datetime,select,image,file hidden表示置空
              *  column.style            自定义style格式
              *  column.options          *insert_type或type为select时 多选项
              *  column.options_limit    *insert_type或type为select时 多选项选择限制数 数字类型默认0:无限制
              *  column.format           *insert_type或type为datetime时时间格式 数字类型默认0: YYYY-MM-DD HH:mm:ss | 1: YYYY-MM-DD | 2: YYYY
     * @param array $data 数据集
     * @param array $style 组件样式设置 宽:width 高:height
     * @param array $options 操作列设置
     *      options.sortable      bool 可排序
     *      options.delete        bool 可删除
     *      options.insert        bool 可新增
     * @return string
     */
    public static function panel($name,array $columns, array $data, array $style = [], array $options = ['sortable' => true, 'delete' => true, 'insert' => true])
    {
        $columns = json_encode($columns, JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_HEX_APOS | JSON_FORCE_OBJECT);
        $data = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_HEX_APOS);
        $style = array_merge(['width' => '100%', 'height' => '355px'], $style);
        $style_string = '';
        foreach ($style as $k => $s) {
            $style_string .= "$k:$s;";
        }
        $options = json_encode(array_merge(['sortable' => true, 'delete' => true, 'insert' => true], $options));

        return <<<EOF
<div id="{$name}" style="$style_string"></div>
<script>
new ComponentLine("{$name}",JSON.parse('{$columns}'),JSON.parse('{$data}'),JSON.parse('{$options}'));
</script>
EOF;
    }
}
