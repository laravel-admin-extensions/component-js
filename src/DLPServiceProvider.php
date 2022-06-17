<?php

namespace DLP;

use Illuminate\Support\ServiceProvider;

class DLPServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'dlp');

        $this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/dlp/')
        ]);
    }
}