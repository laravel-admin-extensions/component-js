<?php


namespace DLP\Assembly\Abs;


interface Layout
{
    public function append($document);
    public function __invoke();
}
