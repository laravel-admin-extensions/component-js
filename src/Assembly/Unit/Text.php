<?php


namespace DLP\Assembly\Unit;

/**
 * Class Text
 * @package DLP\Assembly\Unit
 */
abstract class Text
{
    protected $type;
    protected $column;
    protected $label;
    protected $value;
    protected $settings = "";

    public function __construct(string $type,string $column, string $label)
    {
        $this->type = $type;
        $this->column = $column;
        $this->label = $label;
    }

    public function value($value)
    {
        $this->value = $value;
        return $this;
    }

    public function readOnly()
    {
        $this->settings .= " readonly";
        return $this;
    }

    public function required()
    {
        $this->settings .= " required";
        return $this;
    }

    public function disabled()
    {
        $this->settings .= " disabled";
        return $this;
    }

    public function setAttribute(array $attributes)
    {
        foreach ($attributes as $attribute=>$value){
            $this->settings .= " {$attribute}='{$value}'";
        }
        return $this;
    }

    public function setStyle(array $styles)
    {
        $this->styles = $styles;
        $result = ' style="';
        foreach ($styles as $style=>$value){
            $result .= "{$style}:'{$value}';";
        }

        $this->settings .= $result;
        return $this;
    }

    public function maxlength($len)
    {
        $this->settings .= " maxlength={$len}";
        return $this;
    }

    public function minlength($len)
    {
        $this->settings .= " minlength={$len}";
        return $this;
    }

    public function range($min,$max)
    {
        $this->settings .= " min={$min} max={$max}";
        return $this;
    }

    public function compile()
    {
        return <<<EOF
<div class="dlp dlp-form-row">
    <label class="dlp-text" for="{$this->column}">{$this->label}</label>
    <input type="{$this->type}" id="{$this->column}" name="{$this->column}" value="{$this->value}" class="dlp-input" placeholder="输入 {$this->label}" {$this->settings}/>
</div>
EOF;
    }
}
