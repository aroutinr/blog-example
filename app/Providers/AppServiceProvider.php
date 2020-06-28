<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('admin.categories.*', function ($view) {
            $view->with('title', \App\Category::TITLE);
        });
        View::composer('admin.posts.*', function ($view) {
            $view->with('title', \App\Post::TITLE);
        });
        View::composer('admin.users.*', function ($view) {
            $view->with('title', \App\User::TITLE);
        });
    }
}
