<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CentralServicesServiceProvider extends ServiceProvider
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
            \App\CentralServices\User\Services\Interfaces\CredentialInterface::class,
            \App\CentralServices\User\Services\Implement\CredentialServiceImpl::class
        );
    }
}
