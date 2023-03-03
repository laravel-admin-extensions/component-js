<?php


namespace DLP\Assembly\Abs;

use DLP\Tool\Assistant;

/**
 * Class Input
 * @package DLP\Assembly\Abs
 */
abstract class Input
{
    protected $type = 'text';
    protected $column;
    protected $label;
    protected $value;
    protected $style = [];
    protected $attribute = [];
    protected $enumerate = [];
    protected $annotation;

    public function __construct(string $column)
    {
        $this->column = $column;
    }

    /**
     * @param $value
     * @return $this
     */
    public function value($value)
    {
        $this->value = $value;
        return $this;
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
     * @param $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return $this
     */
    public function readOnly()
    {
        $this->enumerate[] = 'readonly';
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
     * @return $this
     */
    public function disabled()
    {
        $this->enumerate[] = 'disabled';
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

    /**
     * @param int $len
     * @return $this
     */
    public function maxlength(int $len)
    {
        $this->enumerate[] = "maxlength={$len}";
        return $this;
    }

    /**
     * @param int $len
     * @return $this
     */
    public function minlength(int $len)
    {
        $this->enumerate[] = "minlength={$len}";
        return $this;
    }

    /**
     * @param int $min
     * @param int $max
     * @return $this
     */
    public function range(int $min,int $max)
    {
        $this->enumerate[] = "min={$min} max={$max}";
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
