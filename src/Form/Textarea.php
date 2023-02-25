<?php


namespace DLP\Form;

/**
 * Class Textarea
 * @package DLP\Form
 */
class Textarea extends Text
{
    public function __construct(string $column, string $label)
    {
        parent::__construct('textarea',$column, $label);
    }
    
    public function rows(int $rows)
    {
        $this->settings .= " rows={$rows}";
        return $this;
    }

    public function compile()
    {
        return <<<EOF
<div class="dlp-form-row">
    <label class="dlp-text" for="{$this->column}">{$this->label}</label>
    <textarea id="{$this->column}" name="{$this->column}" class="dlp-input {$this->column}" placeholder="输入 {$this->label}" {$this->settings}>{$this->value}</textarea>
</div>
EOF;
    }
}
