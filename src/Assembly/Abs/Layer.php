<?php


namespace DLP\Assembly\Abs;


interface Layer
{
    public function __toString();
    public function trigger($selector, $event = 'click');
    public function setTitle($title);
    public function options(array $options);
}
