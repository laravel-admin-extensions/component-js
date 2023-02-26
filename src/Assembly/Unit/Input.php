<?php


namespace DLP\Assembly\Unit;

use DLP\Tool\Assistant;

/**
 * Class Text
 * @package DLP\Assembly\Unit
 */
abstract class Input
{
    protected $type = 'text';
    protected $column;
    protected $label;
    protected $value;
    protected $settings = [];

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
        $this->settings[] = 'readonly';
        return $this;
    }

    public function required()
    {
        $this->settings[] = 'required';
        return $this;
    }

    public function disabled()
    {
        $this->settings[] = 'disabled';
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

    public function maxlength($len)
    {
        $this->settings[] = 'maxlength={$len}';
        return $this;
    }

    public function minlength($len)
    {
        $this->settings[] = 'minlength={$len}';
        return $this;
    }

    public function range($min, $max)
    {
        $this->settings[] = 'min={$min} max={$max}';
        return $this;
    }

    abstract public function compile();
}
