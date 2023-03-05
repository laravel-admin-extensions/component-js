<?php

namespace DLP\Assembly\Layout;

use DLP\Assembly\Abs\Input;
use DLP\Assembly\Abs\Widget;

class Section
{
    private $name;
    private $cols = 2;
    private $documents = [];

    public function __construct($name,$cols)
    {
        $this->name = $name;
        $this->cols = $cols;
    }

    public function append($document)
    {
        if($document instanceof Input || $document instanceof Widget) $this->documents[] = $document;
    }

    public function __invoke()
    {
        $html = "";
        foreach ($this->documents as $document) {
            $html .= $document();
        }
        $cols = str_repeat(" 1fr ",$this->cols);
        return sprintf("<div class='dlp-section' style='grid-template-columns:{$cols}'>%s</div>",$html);
    }
}
