<?php

namespace LaravelDaddy\SwiftMedia;

use Illuminate\Support\ServiceProvider;
use LaravelDaddy\SwiftMedia;

class SwiftMediaServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishesMigrations([
            __DIR__ . '/database/migrations' => database_path('migrations')
        ], 'swift-media-migrations');
    }

    public function register()
    {
        $this->app->singleton('swift-media', function ($app) {
            return new SwiftMedia();
        });

        if (file_exists(__DIR__ . '/helpers.php')) {
            require_once __DIR__ . '/helpers.php';
        }
    }

}
