<?php

namespace DLP\Assembly\Layout;

use DLP\Assembly\Abs\Component;
use DLP\Assembly\Abs\Input;
use DLP\Assembly\Abs\Widget;

class Section
{
    private $cols = 2;
    private $style = '';
    private $documents = [];

    public function __construct($cols, $style)
    {
        $this->cols = $cols;
        $this->style = $style;
    }

    public function append($document)
    {
        if ($document instanceof Component) $this->documents[] = $document;
    }

    public function __invoke()
    {
        $html = "";
        foreach ($this->documents as $document) {
            $html .= $document();
        }
        $cols = str_repeat(" 1fr ", $this->cols);
        return sprintf("<div class='dlp-section' style='grid-template-columns:{$cols};{$this->style}'>%s</div>", $html);
    }
}
