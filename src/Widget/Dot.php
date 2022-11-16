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
        $menu = json_encode([
            'mode'=>isset($this->attributes['mode']) && $this->attributes['mode'] === true ? true : false,
            'placeholder'=>isset($this->attributes['placeholder']) ? $this->attributes['placeholder'] : '未选择',
            'height'=>isset($this->attributes['menu_height']) ? $this->attributes['menu_height'] : '150px']);
        $this->addVariables(['width' => $width, 'height' => $height]);
        $select = json_encode($this->options, JSON_FORCE_OBJECT | JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_HEX_APOS);
        $selected = json_encode($this->checked);
        $this->script = <<<EOT
new ComponentDot("{$id}",JSON.parse('{$select}'),JSON.parse('{$selected}'),{$limit},{$menu});
EOT;
        return parent::render();
    }

    /**
     * 直接调用ComponentDot组件
     * @param string $name 名称
     * @param array $select 全部选项
     * @param array $selected 已选择id组 [1,2,3...]
     * @param int $limit 选择限制数 默认0:无限
     * @param array $setting 组件配置
     *      mode 选择器下拉列表模式 false:默认经典模式 true:下拉模式
     *      placeholder 下拉列表默认展位
     *      width      容器宽 例.100% 100px
     *      height     容器高 例.200px
     *      menu_height 下拉列表高度限制 例.200px
     * @return string
     */
    public static function panel($name, array $select, array $selected, int $limit = 0, array $setting = [])
    {
        $selected = json_encode($selected, JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_HEX_APOS);
        $select = json_encode($select, JSON_FORCE_OBJECT | JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_HEX_APOS);
        $setting = array_merge(['mode'=>false,'placeholder'=>'请选择','width' => '100%','height'=>'200px','menu_height'=>'150px'], $setting);
        $style = $setting['mode'] === true ? "witdh:{$setting['width']};" : "witdh:{$setting['width']};height:{$setting['height']}";

        $menu = json_encode(['mode'=>$setting['mode'],'placeholder'=>$setting['placeholder'],'height'=>$setting['menu_height']]);
        return <<<EOF
<div id="{$name}" style="$style"></div><script>new ComponentDot("{$name}",JSON.parse('{$select}'),JSON.parse('{$selected}'),{$limit},{$menu}});</script>
EOF;
    }
}
