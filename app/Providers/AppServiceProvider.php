<?php

namespace App\Providers;

use App\Category;
use App\Post;
use App\User;
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
            $view->with('title', Category::TITLE);
        });
        View::composer('admin.posts.*', function ($view) {
            $view->with('title', Post::TITLE);
        });
        View::composer('admin.users.*', function ($view) {
            $view->with('title', User::TITLE);
        });
        View::composer('blog.*', function ($view) {
            $view->with('categories', Category::whereHas('posts')->get());
            $view->with('posts_filter_by_month', Post::postsFilterByMonth());
        });
    }
}
