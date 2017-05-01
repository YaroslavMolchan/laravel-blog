<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Repositories\UserRepository::class, \App\Repositories\UserRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ArticleRepository::class, \App\Repositories\ArticleRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ArticlesCommentRepository::class, \App\Repositories\ArticlesCommentRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\CategoryRepository::class, \App\Repositories\CategoryRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\TagRepository::class, \App\Repositories\TagRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\SubscriptionRepository::class, \App\Repositories\SubscriptionRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\BookRepository::class, \App\Repositories\BookRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\BookAuthorRepository::class, \App\Repositories\BookAuthorRepositoryEloquent::class);
        //:end-bindings:
    }
}
