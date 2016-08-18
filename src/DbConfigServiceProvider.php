<?php

namespace Jani\DbConfig;

use Jani\DbConfig\Services\YunpianSMSService;
use Illuminate\Support\ServiceProvider;

class DbConfigServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/config.php' => base_path('config/db_config.php'),
        ]);
        $this->publishes([__DIR__ . '/../../database/migrations/' => base_path('database/migrations')], 'migrations');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('DbConfigService', function($app){
            return new DbConfigService();
        });
    }
}
