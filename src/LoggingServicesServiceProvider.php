<?php

namespace Dzaki236\LoggingServices;

use Dzaki236\LoggingServices\commands\PublishLoggingServices;
use Illuminate\Support\ServiceProvider;

class LoggingServicesServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
      $this->app->singleton('logging-services:publish', function ($app) {
        return new PublishLoggingServices;
       });

      $this->commands([
          'logging-services:publish',
      ]);
    }
}