<?php

namespace App\Observers\CentralDomain;

use App\Models\Gym\Tenant;
use App\Notifications\WelcomeNewTenant;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;

class TenantObserver implements ShouldHandleEventsAfterCommit
{
    /**
     * Handle the Tenant "created" event.
     */
    public function creating(Tenant $tenant): void
    {
    }

    public function created(Tenant $tenant): void
    {
    }

    /**
     * Handle the Tenant "updated" event.
     */
    public function updated(Tenant $tenant): void
    {
        //
    }

    /**
     * Handle the Tenant "deleted" event.
     */
    public function deleted(Tenant $tenant): void
    {
        //
    }

    /**
     * Handle the Tenant "restored" event.
     */
    public function restored(Tenant $tenant): void
    {
        //
    }

    /**
     * Handle the Tenant "force deleted" event.
     */
    public function forceDeleted(Tenant $tenant): void
    {
        //
    }
}
