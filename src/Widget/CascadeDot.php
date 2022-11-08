<?php

namespace DLP\Widget;

use DLP\DLPField;

/**
 * 点 - 级联选择器
 * Class CascadeDot
 * @package DLP\Widget
 */
class CascadeDot extends DLPField
{
    protected $view = 'dlp::component';

    public function render()
    {
        $id = $this->formatName($this->id);
        $limit = isset($this->attributes['limit']) ? (int)$this->attributes['limit'] : 0;
        $width = isset($this->attributes['width']) ? $this->attributes['width'] : '100%';
        $height = isset($this->attributes['height']) ? $this->attributes['height'] : '230px';
        $this->addVariables(['width'=>$width,'height' => $height]);
        $select = json_encode($this->options, JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_HEX_APOS);
        $selected = json_encode($this->checked);
        $this->script = <<<EOT
new ComponentCascadeDot("{$id}",JSON.parse('{$selected}'),JSON.parse('{$select}'),{$limit});
EOT;
        return parent::render();
    }

    /**
     * 直接调用ComponentCascadeDot组件
     * @param string $name      名称
     * @param array $selected   已选择id组 [1,2,3...]
     * @param array $select     全部选项
     * @param int $limit        选择限制数 默认0:无限
     * @param array $style      组件样式设置 宽:width 高:height
     * @return string
     */
    public static function panel($name,array $selected,array $select,int $limit=1,array $style=[])
    {
        $selected = json_encode($selected, JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_HEX_APOS);
        $select = json_encode($select, JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_HEX_APOS);
        $style = array_merge(['width'=>'100%','height'=>'230px'],$style);
        $style_string = '';
        foreach ($style as $k=>$s){
            $style_string.="$k:$s;";
        }

        return <<<EOF
<div id="{$name}" style="$style_string"></div>
<script>
new ComponentCascadeDot("{$name}",JSON.parse('{$selected}'),JSON.parse('{$select}'),{$limit});
</script>
EOF;
    }
}
