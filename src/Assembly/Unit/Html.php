<?php


namespace DLP\Assembly\Unit;

/**
 * Class Html
 * @package DLP\Assembly\Unit
 */
class Html
{
    private $column;
    private $label;
    private $content;
    private $pure = false;

    public function __construct(string $column, string $label,string $content)
    {
        $this->column = $column;
        $this->label = $label;
        $this->content = $content;
    }

    public function pure()
    {
        $this->pure = true;
        return $this;
    }

    public function compile()
    {
        if($this->pure){
            return $this->content;
        }
        return <<<EOF
<div class="dlp dlp-form-row">
    <label class="dlp-text" for="{$this->column}">{$this->label}</label>
    {$this->content}
</div>
EOF;
    }
}
