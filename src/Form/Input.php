<?php


namespace DLP\Form;

/**
 * Class Input
 * @package DLP\Form
 */
class Input extends Text
{
    public function __construct(string $type,string $column, string $label)
    {
        parent::__construct($type,$column, $label);
    }

    public function compile()
    {
        return <<<EOF
<div class="dlp-form-row">
    <label class="dlp-text" for="{$this->column}">{$this->label}</label>
    <input type="{$this->type}" id="{$this->column}" name="{$this->column}" value="{$this->value}" class="dlp-input {$this->column}" placeholder="输入 {$this->label}" {$this->settings}/>
</div>
EOF;
    }
}
