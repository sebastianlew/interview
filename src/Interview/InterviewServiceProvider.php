<?php

namespace SebastianLew\Interview;

use Illuminate\Support\ServiceProvider;
use Sebastianlew\Interview\Console\MigrationCommand;

class InterviewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('command.migration', function () {
            return new MigrationCommand;
        });

        $this->commands(['command.migration']);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['command.migration'];
    }
}
