<?php

namespace MyPackage\allegro;

use Illuminate\Support\ServiceProvider;

class allegroServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'mypackage');

         $this->loadViewsFrom(__DIR__.'/resources/views', 'allegro');
         $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        //$this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/public' => base_path('/passport'),
            ], 'allegro');

            $this->bootForConsole();
            $this->commands([
                Console\InstallCommand::class,
                Console\ClientCommand::class,
                Console\KeysCommand::class,
            ]);
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/allegro.php', 'allegro');

        // Register the service the package provides.
        $this->app->singleton('allegro', function ($app) {
            return new allegro;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['allegro'];
    }
    
    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/allegro.php' => config_path('allegro.php'),
        ], 'allegro.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/mypackage'),
        ], 'allegro.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/mypackage'),
        ], 'allegro.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/mypackage'),
        ], 'allegro.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
