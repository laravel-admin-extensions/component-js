<?php

namespace DLP\Assembly\Layout;

use DLP\Assembly\Abs\Input;
use DLP\Assembly\Abs\Widget;

class Section
{
    private $name;
    private $documents = [];

    public function __construct($name)
    {
        $this->name = $name;
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

        return sprintf("<div class='dlp-section'>%s</div>",$html);
    }
}
