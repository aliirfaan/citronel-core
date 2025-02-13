<?php

namespace aliirfaan\CitronelCore;

use aliirfaan\CitronelCore\Services\CitronelHelperService;

class CitronelCoreProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/citronel.php' => config_path('citronel.php'),
            __DIR__.'/../config/citronel-cache.php' => config_path('citronel-cache.php'),
        ]);

        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'citronel-core');
    }

    public function register()
    {
        $this->registerExceptionContext();

        $this->app->bind('aliirfaan\CitronelCore\Services\CitronelHelperService', function ($app) {
            return new CitronelHelperService();
        });
    }

    protected function registerExceptionContext()
    {
        $this->app->extend(ExceptionHandler::class, function ($handler, $app) {
            return tap($handler, function ($handler) {
                $handler->context(function () {
                    return [
                        'server' => request()->server('SERVER_ADDR'),
                    ];
                });
            });
        });
    }
}
