<?php

namespace Media;

use Illuminate\Support\ServiceProvider;

class MediaServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Publish config, migrations, views, etc.
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'media');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        $this->publishes([
            __DIR__ . '/resources/views' => resource_path('views'),

            __DIR__ . '/resources/assets' => public_path('media'),

            __DIR__ . '/resources/assets' => public_path('media-assets'),
        ], 'media');
    }
}
