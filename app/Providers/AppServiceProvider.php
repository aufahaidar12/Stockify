<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // $this->app->bind(\App\Services\StockTransactionService::class, \App\Services\Impl\StockTransactionServiceImpl::class);
        // $this->app->bind(\App\Repositories\StockTransactionRepository::class, \App\Repositories\Impl\StockTransactionRepositoryImpl::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
