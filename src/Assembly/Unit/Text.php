<?php


namespace DLP\Assembly\Unit;

/**
 * Class Input
 * @package DLP\Assembly\Unit
 */
class Text extends Input
{
    public function __construct(string $column, string $label)
    {
        parent::__construct($column, $label);
    }

    public function compile()
    {
        $this->settings = (string)join(' ', $this->settings);
        return <<<EOF
<div class="dlp dlp-form-row">
    <label class="dlp-text" for="{$this->column}">{$this->label}</label>
    <input type="{$this->type}" name="{$this->column}" value="{$this->value}" class="dlp-input" placeholder="输入 {$this->label}" {$this->settings}/>
</div>
EOF;
    }
}
