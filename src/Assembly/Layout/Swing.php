<?php


namespace DLP\Assembly\Layout;


use DLP\Assembly\Abs\Component;
use DLP\Assembly\Abs\Layout;

class Swing implements Layout
{
    private $column;
    private $documents = [];

    public function __construct($column)
    {
        $this->column = $column;
    }

    public function append($document)
    {
        if ($document instanceof Component || $document instanceof Layout) $this->documents[] = $document;
    }

    public function __invoke()
    {
        $html = "";
        foreach ($this->documents as $document) {
            $html .= $document();
        }

        return sprintf("<div id='dlp-swing-{$this->column}'>%s</div>", $html);
    }
}
