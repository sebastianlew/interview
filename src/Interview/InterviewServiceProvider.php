<?php

namespace SebastianLew\Interview;

use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Sebastianlew\Interview\Console\MigrationCommand;
use Sebastianlew\Interview\Exceptions\Handler;

class InterviewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../migrations');
        $this->mapApiRoutes();
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ExceptionHandler::class, Handler::class);
    }

    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace('Sebastianlew\Interview\Api\Controllers')
            ->group(__DIR__.'/Api/routes.php');
    }
}
