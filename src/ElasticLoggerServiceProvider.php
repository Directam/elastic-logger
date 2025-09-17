<?php

namespace Directam\ElasticLogger;

use Illuminate\Support\ServiceProvider;

class ElasticLoggerServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/elastic-logger.php', 'elastic-logger');
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/elastic-logger.php' => config_path('elastic-logger.php'),
        ], 'config');

        $this->app['config']->set('logging.channels.elastic', config('elastic-logger'));
    }
}


