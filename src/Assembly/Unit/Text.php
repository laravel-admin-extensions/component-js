<?php


namespace DLP\Assembly\Unit;

use DLP\Assembly\Abs\Input;

/**
 * Class Text
 * @package DLP\Assembly\Unit
 */
class Text extends Input
{
    public function __construct(string $column)
    {
        parent::__construct($column);
    }

    public function __toString()
    {
        $this->annotate();
        $content = <<<EOF
<input type="{$this->type}" name="{$this->column}" value="{$this->value}" class="dlp-input" placeholder="输入 {$this->label}" {$this->annotation}/>
EOF;
        if(!$this->label) return $content;

        return <<<EOF
<div class="dlp dlp-form-row">
    <div class="dlp-form-label dlp-text" for="{$this->column}">{$this->label}</div>
    {$content}
</div>
EOF;
    }
}
