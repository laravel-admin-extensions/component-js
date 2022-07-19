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
            Admin::css('vendor/dlp/component.min.css?v21');
            Admin::js('vendor/dlp/component.min.js?v21');
            Form::extend('Dot', Dot::class);
        });
    }
}
