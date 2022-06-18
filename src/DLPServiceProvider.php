<?php

namespace DLP;

use Illuminate\Support\ServiceProvider;
use Encore\Admin\Admin;

class DLPServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'dlp');

        $this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/dlp/')
        ]);

        Admin::booting(function () {
            Admin::js('vendor/dlp/component.min.js');
        });
    }
}