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
            Admin::css('vendor/dlp/component.css?v'.mt_rand(0,100));
            Admin::js('vendor/dlp/component.js?v'.mt_rand(0,100));
            Form::extend('Dot', Dot::class);
            Form::extend('CascadeDot', CascadeDot::class);
            Form::extend('Linear', Linear::class);
            Form::extend('CascadeLine', CascadeLine::class);
        });
    }
}
