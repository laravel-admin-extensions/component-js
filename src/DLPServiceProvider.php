<?php

namespace DLP;

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
            Admin::css('vendor/dlp/component.min.css');
            Admin::js('vendor/dlp/component.min.js');
            Form::extend('Dot', Dot::class);
            Form::extend('CascadeDot', CascadeDot::class);
            Form::extend('Linear', Linear::class);
        });
    }
}
