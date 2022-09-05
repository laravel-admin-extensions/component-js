<?php

namespace DLP\Tool;


/**
 * Class FormPanel
 * @package DLP\Tool
 */
class FormPanel
{
    private $html = '';

    /**
     * @param string $column
     * @param string $label
     * @param string $value
     */
    public function input(string $column, string $label, string $value = '')
    {
        $content = <<<EOF
<input required="1" type="text" id="{$column}" name="{$column}" value="{$value}" class="dlp-input {$column}" placeholder="输入 {$label}" />
EOF;
        $this->html .= $this->rowpanel($column, $label, $content);
    }

    /**
     * @param string $column
     * @param string $value
     */
    public function hidden(string $column, string $value)
    {
        $this->html .= <<<EOF
<input type="hidden" id="{$column}" name="{$column}" value="{$value}" />
EOF;
    }

    /**
     * @param string $column
     * @param string $label
     * @param string $value
     */
    public function textarea(string $column, string $label, string $value = '')
    {
        $content = <<<EOF
<textarea name="{$column}" class="{$column}" rows="3" placeholder="输入 {$label}">{$value}</textarea>
EOF;
        $this->html .= $this->rowpanel($column, $label, $content);
    }

    public function select(string $column, string $label, array $selected, array $select,$limit=0,array $style=[])
    {
        $selected = json_encode($selected, JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_HEX_APOS);
        $select = json_encode($select, JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_HEX_APOS);
        $style = array_merge(['width'=>'100%','height'=>'62px'],$style);
        $style_string = '';
        foreach ($style as $k=>$s){
            $style_string.="$k:$s;";
        }
        $content = <<<EOF
<div id="{$column}" style="$style_string"></div>
<script>
new ComponentDot("{$column}",JSON.parse('{$selected}'),JSON.parse('{$select}'),{$limit});
</script>
EOF;
        $this->html .= $this->rowpanel($column, $label, $content);
    }

    /**
     * @param string $column
     * @param string $label
     * @param string $value
     */
    public function datepicker(string $column, string $label, string $value = '')
    {
        if (!$value) {
            $value = date('Y-m-d H:i:s');
        }
        $content = <<<EOF
<input style="width: 160px" type="text" id="{$column}" name="{$column}" value="{$value}" class="dlp-input {$column}" placeholder="输入 {$label}" />
<script>
$('#{$column}').datetimepicker({"format":"YYYY-MM-DD HH:mm:ss","locale":"zh-CN"});
$('#{$column}').on(
        'dp.show',
        function(e) {
        $(".bootstrap-datetimepicker-widget").css(
        "background-color", "#3c3e43");
        });
</script>
EOF;
        $this->html .= $this->rowpanel($column, $label, $content);
    }

    /**
     * @param string $column
     * @param string $label
     * @param string $content
     */
    public function html(string $column, string $label, string $content)
    {
        $this->html .= $this->rowpanel($column, $label, $content);
    }

    public function compile()
    {
        return <<<EOF
<form class="dlp" accept-charset="UTF-8" method="post">
    <div>{$this->html}</div>
</form>
EOF;
    }

    private function rowpanel($column, $label, $content)
    {
        return <<<EOF
<div class="dlp-form-row">
    <label class="dlp-text" for="{$column}">{$label}</label>
    {$content}
</div>
EOF;
    }
}
