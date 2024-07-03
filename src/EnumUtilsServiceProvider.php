<?php

declare(strict_types=1);

namespace Ilyes512\EnumUtils;

use Illuminate\Support\ServiceProvider;

class EnumUtilsServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/enum_utils.php', 'enum_utils');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            return;
        }

        $this->publishes([
            __DIR__ . '/../config/enum_utils.php' => $this->app->configPath('enum_utils.php'),
        ], 'enum-utils-config');
    }
}
