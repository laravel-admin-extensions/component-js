<?php


namespace DLP\Form;

/**
 * Class Input
 * @package DLP\Form
 */
class Input
{
    private $column;
    private $label;
    private $value;

    public function __construct(string $column, string $label, string $value)
    {
        $this->column = $column;
        $this->label = $label;
        $this->value = $value;
    }

    public function readOnly()
    {

    }

    public function setAttribute()
    {

    }

    public function setStyle()
    {

    }

    public function compile()
    {
        
    }
}
