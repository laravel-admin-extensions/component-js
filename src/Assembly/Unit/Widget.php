<?php


namespace DLP\Assembly\Unit;

use DLP\Tool\Assistant;

/**
 * Class Wiget
 * @package DLP\Assembly\Unit
 */
abstract class Widget
{
    protected $column;
    protected $label;
    protected $pure = false;
    protected $style = [];
    protected $attribute = [];
    protected $enumerate = [];
    protected $annotation;

    public function __construct(string $column, string $label)
    {
        $this->column = $column;
        $this->label = $label;
    }

    public function required()
    {
        $this->enumerate[] = 'required';
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

    public function pure()
    {
        $this->pure = true;
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
