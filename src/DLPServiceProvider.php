<?php

namespace DLP;

use DLP\Widget\CascadeDot;
use DLP\Widget\CascadeLine;
use DLP\Widget\Dot;
use DLP\Widget\Linear;
use Illuminate\Support\ServiceProvider;
use Encore\Admin\Admin;
use Encore\Admin\Form;

class DLPServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'dlp');

        $this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/dlp/')
        ]);

        Admin::booting(function () {
            Admin::css('vendor/dlp/component.min.css?v3');
            Admin::headerJs('vendor/dlp/component.min.js?v3');
            Form::extend('Dot', Dot::class);
            Form::extend('CascadeDot', CascadeDot::class);
            Form::extend('Linear', Linear::class);
            Form::extend('CascadeLine', CascadeLine::class);
        });
    }
}
