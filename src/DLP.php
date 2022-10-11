<?php

namespace DLP;

use Encore\Admin\Extension;

class DLP extends Extension
{
    public $name = 'dlp';

    public $views = __DIR__.'/../resources/views';

    public $assets = __DIR__.'/../resources/assets';
}
