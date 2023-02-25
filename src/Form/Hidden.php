<?php


namespace DLP\Form;

/**
 * Class Hidden
 * @package DLP\Form
 */
class Hidden
{
    private $column;
    private $value;
    
    public function __construct(string $column, string $value)
    {
        $this->column = $column;
        $this->value = $value;
    }

    public function compile()
    {
        return <<<EOF
<input type="hidden" id="{$this->column}" name="{$this->column}" value="{$this->value}" />
EOF;
    }
}
