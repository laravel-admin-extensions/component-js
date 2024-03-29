<?php


namespace DLP\Assembly\Unit;

use DLP\Assembly\Abs\Widget;

/**
 * Class CascadeLine
 * @package DLP\Assembly\Unit
 */
class CascadeLine extends Widget
{
    private $data;
    private $useSearch = false;
    private $useHiddenInput = true;
    private $url;

    public function __construct(string $column, array $data)
    {
        parent::__construct($column);
        $this->data = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_HEX_APOS);
    }

    public function url($url)
    {
        $this->url = $url;
        return $this;
    }

    public function __toString()
    {
        $this->annotate();
        $content = <<<EOF
<div id="{$this->column}" {$this->annotation}></div>
<script>
new ComponentCascadeLine("#{$this->column}", {$this->data},'{$this->url}').make();
</script>
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
