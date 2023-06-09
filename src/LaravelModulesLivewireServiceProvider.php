<?php

namespace Codions\LaravelModulesLivewire;

use Codions\LaravelModulesLivewire\Commands\LivewireMakeCommand;
use Codions\LaravelModulesLivewire\Providers\LivewireComponentServiceProvider;
use Illuminate\Support\ServiceProvider;

class LaravelModulesLivewireServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerProviders();

        $this->registerCommands();

        $this->registerPublishables();

        $this->mergeConfigFrom(
            __DIR__ . '/../config/modules-livewire.php',
            'modules-livewire'
        );
    }

    protected function registerProviders()
    {
        $this->app->register(LivewireComponentServiceProvider::class);
    }

    protected function registerCommands()
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->commands([
            LivewireMakeCommand::class,
        ]);
    }

    protected function registerPublishables()
    {
        $this->publishes([
            __DIR__ . '/../config/modules-livewire.php' => base_path('config/modules-livewire.php'),
        ], ['modules-livewire-config']);

        $this->publishes([
            __DIR__ . '/Commands/stubs/' => base_path('stubs/modules-livewire'),
        ], ['modules-livewire-stub']);
    }
}
