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
<div class="input-group">
    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
    <input required="1" type="text" id="{$column}" name="{$column}" value="{$value}" class="form-control {$column}" placeholder="输入 {$label}" />
</div>
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
<textarea name="{$column}" class="form-control {$column}" rows="3" placeholder="输入 {$label}">{$value}</textarea>
EOF;
        $this->html .= $this->rowpanel($column, $label, $content);
    }

    public function select(string $column, array $options, int $selected)
    {

    }

    public function multiSelect(string $column, array $options, array $selected)
    {

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
<div class="input-group">
    <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
    <input style="width: 160px" type="text" id="{$column}" name="{$column}" value="{$value}" class="form-control release_time" placeholder="输入 {$label}" />
</div>
EOF;
        Admin::script(<<<EOF
$('#{$column}').datetimepicker({"format":"YYYY-MM-DD HH:mm:ss","locale":"zh-CN"});
$('#{$column}').on(
        'dp.show',
        function(e) {
        $(".bootstrap-datetimepicker-widget").css(
        "background-color", "#3c3e43");
        });
EOF
        );
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
<form accept-charset="UTF-8" method="post">
    <div class="box-body">{$this->html}</div>
</form>
EOF;
    }

    private function rowpanel($column, $label, $content)
    {
        return <<<EOF
<div class="form-group">
    <label for="{$column}" class="col-sm-2 control-label">{$label}</label>
    <div class="col-sm-8">
        {$content}
    </div>
</div>
EOF;
    }
}
