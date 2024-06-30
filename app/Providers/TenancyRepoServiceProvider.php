<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class TenancyRepoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->bind(
            \App\TenancyServices\User\Repositories\Interfaces\TenantUserRepoInterface::class,
            \App\TenancyServices\User\Repositories\Implements\TenantUserRepoImpl::class
        );
    }
}
