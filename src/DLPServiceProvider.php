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
    public function boot(DLP $extension)
    {
        if (!DLP::boot()) {
            return ;
        }

        if ($views = $extension->views()) {
            $this->loadViewsFrom(__DIR__.'/../resources/views', 'dlp');
        }

        if ($this->app->runningInConsole() && $assets = $extension->assets()) {
            $this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/dlp')
            ]);
        }

        Admin::booting(function () {
            Admin::css('vendor/dlp/component.min.css?v6.8');
            Admin::headerJs('vendor/dlp/component.min.js?v6.8');
        });
    }
}
