<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CentralRepositoryServiceProvider extends ServiceProvider
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
            \App\CentralServices\User\Repositories\Interfaces\CredentialInterface::class,
            \App\CentralServices\User\Repositories\Implement\CredentialRepoImpl::class
        );
        $this->app->bind(
            \App\CentralServices\SubscriptionPlan\Repositories\Interfaces\FeaturePlanInterface::class,
            \App\CentralServices\SubscriptionPlan\Repositories\Implement\FeaturePlanRepoImpl::class,
        );
    }
}
