<?php

namespace Wimil\Comments;

use Illuminate\Support\ServiceProvider as ServiceProvider;

class Provider extends ServiceProvider
{



    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../migrations');

        $this->publishes([
            __DIR__ . '/../migrations/' => database_path('migrations')
        ], 'migrations');

        $this->publishes([
            __DIR__ . '/../config/comments.php' => config_path('comments.php'),
        ], 'configs');
    }
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/comments.php',
            'comments'
        );
    }
}
