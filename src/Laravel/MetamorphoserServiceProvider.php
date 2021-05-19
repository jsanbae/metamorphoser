<?php

namespace Jsanbae\Metamorphoser\Laravel;

use Jsanbae\Metamorphoser\Laravel\MetamorphoserMakeCommand;

use Illuminate\Support\ServiceProvider;

class MetamorphoserServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // Register the sanitizer factory:
        $this->app->singleton('metamorphoser', function ($app) {
            return new Factory;
        });

        // Register make request command
        $this->commands([
            MetamorphoserMakeCommand::class,
        ]);
    }
}