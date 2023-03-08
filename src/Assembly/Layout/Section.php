<?php

namespace DLP\Assembly\Layout;

use DLP\Assembly\Abs\Component;
use DLP\Assembly\Abs\Input;
use DLP\Assembly\Abs\Layout;
use DLP\Assembly\Abs\Widget;

class Section implements Layout
{
    private $cols = 2;
    private $style = '';
    private $documents = [];

    public function __construct($cols, $style)
    {
        $this->cols = $cols;
        $this->style = $style;
    }

    /**
     * @param Component|Layout $document
     */
    public function append($document)
    {
        if ($document instanceof Component || $document instanceof Layout) $this->documents[] = $document;
    }

    public function __toString()
    {
        $html = "";
        foreach ($this->documents as $document) {
            $html .= $document;
        }
        $cols = str_repeat(" 1fr ", $this->cols);
        return sprintf("<div class='dlp-section' style='grid-template-columns:{$cols};{$this->style}'>%s</div>", $html);
    }
}
