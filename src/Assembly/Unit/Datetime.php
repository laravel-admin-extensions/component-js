<?php


namespace DLP\Assembly\Unit;

use DLP\Assembly\Abs\Input;
/**
 * Class Datetime
 * @package DLP\Assembly\Unit
 */
class Datetime extends Input
{
    private $pickerSettings = [];

    public function __construct(string $column)
    {
        parent::__construct($column);
    }

    /**
     * @param string $pattern
     * @example YYYY-MM-DD HH:mm:ss | YYYY-MM-DD | YYYY |...
     * @return $this
     */
    public function format($pattern = 'YYYY-MM-DD HH:mm:ss')
    {
        $this->pickerSettings['format'] = $pattern;
        return $this;
    }

    /**
     * @param string $lan
     * @example zh-CN
     * @return $this
     */
    public function locale($lan = 'zh-CN')
    {
        $this->pickerSettings['locale'] = $lan;
        return $this;
    }

    public function __toString()
    {
        $pickerSettings = json_encode(array_merge(['format' => 'YYYY-MM-DD HH:mm:ss', 'locale' => 'zh-CN'], $this->pickerSettings));
        $this->annotate();
        $content = <<<EOF
<input type="{$this->type}" name="{$this->column}" value="{$this->value}" class="dlp-input" placeholder="输入 {$this->label}" {$this->annotation}/>
<script>$('input[name="{$this->column}"]').datetimepicker({$pickerSettings});</script>
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
