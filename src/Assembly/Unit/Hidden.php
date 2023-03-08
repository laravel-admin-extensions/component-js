<?php


namespace DLP\Assembly\Unit;

use DLP\Assembly\Abs\Component;

/**
 * Class Hidden
 * @package DLP\Assembly\Unit
 */
class Hidden implements Component
{
    private $column;
    private $value;

    public function __construct(string $column, string $value)
    {
        $this->column = $column;
        $this->value = $value;
    }

    public function __toString()
    {
        return <<<EOF
<input type="hidden" name="{$this->column}" value="{$this->value}" />
EOF;
    }
}
