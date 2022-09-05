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
        $height = isset($this->attributes['height']) ?  $this->attributes['height'] : '230px';
        $this->addVariables(['height'=>$height]);
        $select = json_encode($this->options, JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_HEX_APOS);
        $xhr = $this->xhr ?? '';
        $this->script = <<<EOT
new ComponentCascadeLine("{$id}",JSON.parse('{$select}'),'{$xhr}');
EOT;
        return parent::render();
    }

    public static function panel(array $select,string $xhr,array $style=[])
    {
        $select = json_encode($select, JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_HEX_APOS);
        $style = array_merge(['width'=>'100%','height'=>'230px'],$style);
        $style_string = '';
        foreach ($style as $k=>$s){
            $style_string.="$k:$s;";
        }
        $id = 'cascade_line_'.mt_rand(0,100);
        return <<<EOF
<div id="{$id}" style="$style_string"></div>
<script>
new ComponentCascadeLine("{$id}",JSON.parse('{$select}'),'{$xhr}');
</script>
EOF;
    }
}
