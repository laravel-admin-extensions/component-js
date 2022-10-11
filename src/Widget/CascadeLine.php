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
        $options = isset($this->attributes['options']) ? json_encode($this->attributes['options']) : json_encode(['movable' => true,'exchange' => true,'insert' => true,'update' => true,'delete' => true]);
        $this->script = <<<EOT
new ComponentCascadeLine("{$id}",JSON.parse('{$select}'),'{$xhr}');
EOT;
        return parent::render();
    }

    /**
     * 直接调用ComponentCascadeLine组件
     * @param string $name      名称
     * @param array $select 全部选项
     * @param string $xhr   ajax接口地址
     * @param array $style  组件样式设置 宽:width 高:height
     * @param array $options
     *      options.movable     bool 可迁移节点 (迁移到其他节点子集)
     *      options.exchange    bool 可交换节点 (节点与其子节点相互交换)
     *      options.insert      bool 可新增
     *      options.update      bool 可修改
     *      options.delete      bool 可删除
     * @return string
     */
    public static function panel($name,array $select,string $xhr,array $style=[],array $options=[])
    {
        $select = json_encode($select, JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_HEX_APOS);
        $style = array_merge(['width'=>'100%','height'=>'230px'],$style);
        $style_string = '';
        $options = json_encode(array_merge([
        'movable' => true,
        'exchange' => true,
        'insert' => true,
        'update' => true,
        'delete' => true],$options));
        foreach ($style as $k=>$s){
            $style_string.="$k:$s;";
        }

        return <<<EOF
<div id="{$name}" style="$style_string"></div>
<script>
new ComponentCascadeLine("{$name}",JSON.parse('{$select}'),'{$xhr}',JSON.parse('{$options}'));
</script>
EOF;
    }
}
