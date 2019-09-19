<?php

namespace Wimil\Comments;

use Illuminate\Support\ServiceProvider as ServiceProvider;
use Wimil\Comments\Observer\CommentObserver;

class Provider extends ServiceProvider
{

    public function boot()
    {
        //$this->loadMigrationsFrom(__DIR__ . '/../migrations');

        $timestamp = date('Y_m_d_His', time());

        $this->publishes([
            __DIR__ . '/../migrations/create_comments_table.php' => database_path("migrations/{$timestamp}_create_comments_table.php")
        ], 'migrations');

        $this->publishes([
            __DIR__ . '/../config/comments.php' => config_path('comments.php'),
        ], 'config');

        //register observer
        config('comments.model')::observe(CommentObserver::class);
    }
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/comments.php',
            'comments'
        );
    }
}
