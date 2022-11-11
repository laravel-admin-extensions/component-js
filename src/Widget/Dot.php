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
        $menu_mode = isset($this->attributes['menu_mode']) ? (bool)$this->attributes['menu_mode'] : false;
        $menu_placeholder = isset($this->attributes['menu_placeholder']) ? $this->attributes['menu_mode'] : '未选择';
        $this->addVariables(['width' => $width, 'height' => $height]);
        $select = json_encode($this->options, JSON_FORCE_OBJECT | JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_HEX_APOS);
        $selected = json_encode($this->checked);
        $this->script = <<<EOT
new ComponentDot("{$id}",JSON.parse('{$selected}'),JSON.parse('{$select}'),{$limit},{$menu_mode},'{$menu_placeholder}');
EOT;
        return parent::render();
    }

    /**
     * 直接调用ComponentDot组件
     * @param string $name 名称
     * @param array $selected 已选择id组 [1,2,3...]
     * @param array $select 全部选项
     * @param int $limit 选择限制数 默认0:无限
     * @param array $style 组件样式设置 宽:width 高:height
     * @param boolean $menu_mode 组件模式设置 false:默认模式 true:下拉列表模式
     * @param string $menu_placeholder 下拉列表模式 默认未选择占位
     * @return string
     */
    public static function panel($name, array $selected, array $select, int $limit = 1, array $style = [], $menu_mode = false, $menu_placeholder = '未选择')
    {
        $selected = json_encode($selected, JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_HEX_APOS);
        $select = json_encode($select, JSON_FORCE_OBJECT | JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_HEX_APOS);
        $style = array_merge(['width' => '100%', 'height' => '200px'], $style);
        $style_string = '';
        foreach ($style as $k => $s) {
            $style_string .= "$k:$s;";
        }

        return <<<EOF
<div id="{$name}" style="$style_string"></div><script>new ComponentDot("{$name}",JSON.parse('{$selected}'),JSON.parse('{$select}'),{$limit},{$menu_mode},{$menu_placeholder});</script>
EOF;
    }
}
