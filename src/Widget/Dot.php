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
        $height = isset($this->attributes['height']) ?  $this->attributes['height'] : '200px';
        $limit = isset($this->attributes['limit']) ? (int)$this->attributes['limit'] : 0;
        $this->addVariables(['height'=>$height]);
        $select = json_encode($this->options, JSON_FORCE_OBJECT | JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_HEX_APOS);
        $selected = json_encode($this->checked);
        $this->script = <<<EOT
new ComponentDot("{$id}",JSON.parse('{$selected}'),JSON.parse('{$select}'),{$limit});
EOT;
        return parent::render();
    }

    public static function panel(array $selected,array $select,int $limit=1,array $style=[])
    {
        $selected = json_encode($selected, JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_HEX_APOS);
        $select = json_encode($select, JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_HEX_APOS);
        $style = array_merge(['height'=>'200px'],$style);
        $style_string = '';
        foreach ($style as $k=>$s){
            $style_string.="$k:$s;";
        }
        $id = 'dot_'.mt_rand(0,100);
        return <<<EOF
<div id="{$id}" style="$style_string"></div>
<script>
new ComponentDot("{$id}",JSON.parse('{$selected}'),JSON.parse('{$select}'),{$limit});
</script>
EOF;
    }
}
