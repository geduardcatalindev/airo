<?php

namespace App\Providers;

use App\Repositories\Interfaces\QuotationRepositoryInterface;
use App\Repositories\QuotationRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(QuotationRepositoryInterface::class, QuotationRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
