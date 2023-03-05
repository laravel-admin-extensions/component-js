<?php


namespace DLP\Assembly\Unit;

use DLP\Assembly\Abs\Input;
/**
 * Class Textarea
 * @package DLP\Assembly\Unit
 */
class Textarea extends Input
{
    public function __construct(string $column)
    {
        parent::__construct($column);
    }

    /**
     * @param int $rows
     * @return $this
     */
    public function rows(int $rows)
    {
        $this->enumerate[] = "rows={$rows}";
        return $this;
    }

    /**
     * @param int $cols
     * @return $this
     */
    public function cols(int $cols)
    {
        $this->enumerate[] = "cols={$cols}";
        return $this;
    }

    public function __invoke()
    {
        $this->annotate();
        $content = <<<EOF
<textarea name="{$this->column}" class="dlp-input {$this->column}" placeholder="输入 {$this->label}" {$this->annotation}>{$this->value}</textarea>
EOF;
        if(!$this->label) return $content;

        return <<<EOF
<div class="dlp dlp-form-row">
    <label class="dlp-text" for="{$this->column}">{$this->label}</label>
    {$content}
</div>
EOF;
    }
}
