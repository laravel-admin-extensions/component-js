<?php

namespace DLP;

use Encore\Admin\Form\Field;

class Dot extends Field
{
    public function render()
    {
        $id = $this->formatName($this->id);
        dd($this);
        $this->script = <<<EOT
console.log(1);
EOT;
        return parent::render();
    }
}
