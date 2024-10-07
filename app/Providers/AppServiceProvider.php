<?php

namespace App\Providers;

use App\Interfaces\IArticleRepository;
use App\Interfaces\INewsApiService;
use App\Interfaces\IUserRepository;
use App\Repositories\ArticleRepository;
use App\Repositories\UserRepository;
use App\Services\NewsApiService;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IArticleRepository::class, ArticleRepository::class);
        $this->app->bind(IUserRepository::class, UserRepository::class);

        $this->app->singleton(INewsApiService::class, NewsApiService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Vite::prefetch(concurrency: 3);
    }
}
