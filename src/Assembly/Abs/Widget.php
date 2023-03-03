<?php


namespace DLP\Assembly\Abs;

use DLP\Tool\Assistant;

/**
 * Class Widget
 * @package DLP\Assembly\Abs
 */
abstract class Widget
{
    protected $column;
    protected $label;
    protected $style = [];
    protected $attribute = [];
    protected $enumerate = [];
    protected $annotation;

    public function __construct(string $column)
    {
        $this->column = $column;
    }

    /**
     * @param $title
     * @return $this
     */
    public function label($title)
    {
        $this->label = $title;
        return $this;
    }

    /**
     * @return $this
     */
    public function required()
    {
        $this->enumerate[] = 'required';
        return $this;
    }

    /**
     * @param array $attributes
     * @return $this
     */
    public function setAttribute(array $attributes)
    {
        $this->attribute = array_merge($this->attribute,$attributes);
        return $this;
    }

    /**
     * @param array $styles
     * @return $this
     */
    public function setStyle(array $styles)
    {
        $this->style = array_merge($this->style,$styles);
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
