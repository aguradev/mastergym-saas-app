<?php

namespace App\Providers;

use App\Models\CentralModel\TenantSubscriptionPlan;
use App\Models\CentralModel\TenantTransaction;
use App\Models\Gym\Tenant;
use App\Observers\CentralDomain\SubscriptionPlanObsever;
use App\Observers\CentralDomain\TenantObserver;
use App\Observers\TenantTransactionObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        Tenant::observe(TenantObserver::class);
        TenantTransaction::observe(TenantTransactionObserver::class);
        TenantSubscriptionPlan::observe(SubscriptionPlanObsever::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
