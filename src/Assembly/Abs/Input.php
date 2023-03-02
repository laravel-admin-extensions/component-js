<?php


namespace DLP\Assembly\Abs;

use DLP\Tool\Assistant;

/**
 * Class Input
 * @package DLP\Assembly\Abs
 */
abstract class Input
{
    protected $pure = false;
    protected $type = 'text';
    protected $column;
    protected $label;
    protected $value;
    protected $style = [];
    protected $attribute = [];
    protected $enumerate = [];
    protected $annotation;

    public function __construct(string $column, string $label)
    {
        $this->column = $column;
        $this->label = $label;
    }

    public function value($value)
    {
        $this->value = $value;
        return $this;
    }

    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function readOnly()
    {
        $this->enumerate[] = 'readonly';
        return $this;
    }

    public function required()
    {
        $this->enumerate[] = 'required';
        return $this;
    }

    public function disabled()
    {
        $this->enumerate[] = 'disabled';
        return $this;
    }

    public function setAttribute(array $attributes)
    {
        $this->attribute = array_merge($this->attribute,$attributes);
        return $this;
    }

    public function setStyle(array $styles)
    {
        $this->style = array_merge($this->style,$styles);
        return $this;
    }

    public function maxlength(int $len)
    {
        $this->enumerate[] = "maxlength={$len}";
        return $this;
    }

    public function minlength(int $len)
    {
        $this->enumerate[] = "minlength={$len}";
        return $this;
    }

    public function range(int $min,int $max)
    {
        $this->enumerate[] = "min={$min} max={$max}";
        return $this;
    }

    public function pure()
    {
        $this->pure = true;
        return $this;
    }

    public function annotate()
    {
        $style = Assistant::arrayKv2String($this->style);
        $attribute = Assistant::arrayKv2String($this->attribute,'=',' ');
        $enumerate = join(' ',$this->enumerate);
        $this->annotation = "{$attribute} {$enumerate} style=\"{$style}\"";
    }

    abstract public function compile();
}
