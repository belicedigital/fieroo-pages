<?php

namespace Fieroo\Pages\Providers;

use Illuminate\Support\ServiceProvider;

class PagesProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        $this->loadViewsFrom(__DIR__.'/../views', 'pages');

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }
}