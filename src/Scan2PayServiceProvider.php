<?php

namespace Chihhaoli\Scan2Pay;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class Scan2PayServiceProvider extends ServiceProvider implements DeferrableProvider
{
    const CONFIG_PATH = __DIR__ . '/../config/scan2pay.php';

    /**
     * {@inheritdoc}
     */
    public function register()
    {
        $this->mergeConfigFrom(self::CONFIG_PATH, 'scan2pay');

        $this->app->singleton(Scan2Pay::class, function ($app) {
            return new Scan2Pay($app['config']->get('scan2pay'));
        });

        $this->app->alias(Scan2Pay::class, 'Scan2Pay');

        $this->app->singleton(Easycard::class, function ($app) {
            return new Easycard($app['config']->get('scan2pay'));
        });

        $this->app->alias(Easycard::class, 'Easycard');
    }

    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__ . '/../lang', 'scan2pay');

        $this->publishes([self::CONFIG_PATH => config_path('scan2pay.php')]);
    }

    /**
     * {@inheritdoc}
     */
    public function provides()
    {
        return [Scan2Pay::class, Easycard::class];
    }
}
