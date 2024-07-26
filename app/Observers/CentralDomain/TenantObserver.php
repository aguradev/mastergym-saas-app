<?php

namespace App\Observers\CentralDomain;

use App\Models\Gym\Tenant;
use Illuminate\Contracts\Events\ShouldDispatchAfterCommit;

class TenantObserver implements ShouldDispatchAfterCommit
{
    /**
     * Handle the Tenant "created" event.
     */
    public function creating(Tenant $tenant): void
    {
        $tenant->created_at = now();
        $tenant->save();
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
