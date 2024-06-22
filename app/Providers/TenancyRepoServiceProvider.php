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
            \App\TenancyService\User\Repositories\Interfaces\TenantUserRepoInterface::class,
            \App\TenancyService\User\Repositories\Implements\TenantUserRepoImpl::class
        );
    }
}
