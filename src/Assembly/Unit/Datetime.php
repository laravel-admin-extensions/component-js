<?php


namespace DLP\Assembly\Unit;

/**
 * Class Datetime
 * @package DLP\Assembly\Unit
 */
class Datetime extends Input
{
    private $pickerSettings = [];

    public function __construct(string $column, string $label)
    {
        parent::__construct($column, $label);
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
        $pickerSettings = json_encode(array_merge(['format' => 'YYYY-MM-DD HH:mm:ss', 'locale' => 'zh-CN'], $this->pickerSettings));
        $this->settings = (string)join(' ', $this->settings);
        $content = <<<EOF
<input type="{$this->type}" name="{$this->column}" value="{$this->value}" class="dlp-input" placeholder="输入 {$this->label}" {$this->settings}/>
<script>$('input[name="{$this->column}"]').datetimepicker({$pickerSettings});</script>
EOF;
        if($this->pure) return $content;
        return <<<EOF
<div class="dlp dlp-form-row">
    <label class="dlp-text" for="{$this->column}">{$this->label}</label>
    {$content}
</div>
EOF;
    }
}
