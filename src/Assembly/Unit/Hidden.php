<?php


namespace DLP\Assembly\Unit;

/**
 * Class Hidden
 * @package DLP\Assembly\Unit
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

    public function __invoke()
    {
        return <<<EOF
<input type="hidden" name="{$this->column}" value="{$this->value}" />
EOF;
    }
}
