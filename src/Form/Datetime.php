<?php


namespace DLP\Form;

/**
 * Class Datetime
 * @package DLP\Form
 */
class Datetime extends Text
{
    private $pickerSettings = [];

    public function __construct(string $column, string $label)
    {
        parent::__construct('text',$column, $label);
    }

    public function format()
    {
        $this->pickerSettings['format'] = 'YYYY-MM-DD HH:mm:ss';
        return $this;
    }

    public function locale()
    {
        $this->pickerSettings['locale'] = 'zh-CN';
        return $this;
    }

    public function compile()
    {
        $settings = json_encode(array_merge(['format'=>'YYYY-MM-DD HH:mm:ss','locale'=>'zh-CN'], $this->pickerSettings));
        return <<<EOF
<div class="dlp-form-row">
    <label class="dlp-text" for="{$this->column}">{$this->label}</label>
    <input type="{$this->type}" id="{$this->column}" name="{$this->column}" value="{$this->value}" class="dlp-input {$this->column}" placeholder="输入 {$this->label}" {$this->settings}/>
    <script>$('#{$this->column}').datetimepicker({$settings});</script>
</div>
EOF;
    }
}