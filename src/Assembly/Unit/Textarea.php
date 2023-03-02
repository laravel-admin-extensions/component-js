<?php


namespace DLP\Assembly\Unit;

use DLP\Assembly\Abs\Input;
/**
 * Class Textarea
 * @package DLP\Assembly\Unit
 */
class Textarea extends Input
{
    public function __construct(string $column, string $label)
    {
        parent::__construct($column, $label);
    }

    public function rows(int $rows)
    {
        $this->settings[] = "rows={$rows}";
        return $this;
    }

    public function cols(int $cols)
    {
        $this->settings[] = "cols={$cols}";
        return $this;
    }

    public function compile()
    {
        $this->annotate();
        $content = <<<EOF
<textarea name="{$this->column}" class="dlp-input {$this->column}" placeholder="输入 {$this->label}" {$this->annotation}>{$this->value}</textarea>
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
