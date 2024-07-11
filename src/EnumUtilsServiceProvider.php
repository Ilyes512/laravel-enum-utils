<?php

declare(strict_types=1);

namespace Ilyes512\EnumUtils;

use Illuminate\Support\ServiceProvider;

class EnumUtilsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->loadTranslationsFrom(__DIR__ . '/../lang', 'enumUtils');

        if ($this->app->runningInConsole()) {
            return;
        }

        $this->publishes([
            __DIR__ . '/../lang' => $this->app->langPath('vendor/enumUtils'),
        ]);
    }
}
