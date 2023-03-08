<?php


namespace DLP\Assembly\Abs;


interface Layout
{
    /**
     * @param Component|Layout $document
     */
    public function append($document);
    public function __toString();
}
