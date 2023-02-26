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
    protected $settings = [];

    public function __construct(string $column, string $label)
    {
        $this->column = $column;
        $this->label = $label;
    }

    public function required()
    {
        $this->settings[] = 'required';
        return $this;
    }

    public function setAttribute(array $attributes)
    {
        $this->settings[] = Assistant::arrayKv2String($attributes, '=', ' ');
        return $this;
    }

    public function setStyle(array $styles)
    {
        $this->settings[] = 'style="' . Assistant::arrayKv2String($styles) . '"';
        return $this;
    }

    public function pure()
    {
        $this->pure = true;
    }

    abstract public function compile();
}
