<?php

namespace App\Observers\CentralDomain;

use App\Models\CentralModel\TenantSubscriptionPlan;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;

class SubscriptionPlanObsever implements ShouldHandleEventsAfterCommit
{
    /**
     * Handle the TenantSubscriptionPlan "created" event.
     */
    public function creating(TenantSubscriptionPlan $tenantSubscriptionPlan): void
    {
        $tenantSubscriptionPlan->status = "ACTIVE";
        $tenantSubscriptionPlan->created_at = now();

        $tenantSubscriptionPlan->save();
    }

    public function created(TenantSubscriptionPlan $tenantSubscriptionPlan): void
    {
    }

    /**
     * Handle the TenantSubscriptionPlan "updated" event.
     */
    public function updated(TenantSubscriptionPlan $tenantSubscriptionPlan): void
    {
        //
    }

    /**
     * Handle the TenantSubscriptionPlan "deleted" event.
     */
    public function deleted(TenantSubscriptionPlan $tenantSubscriptionPlan): void
    {
        //
    }

    /**
     * Handle the TenantSubscriptionPlan "restored" event.
     */
    public function restored(TenantSubscriptionPlan $tenantSubscriptionPlan): void
    {
        //
    }

    /**
     * Handle the TenantSubscriptionPlan "force deleted" event.
     */
    public function forceDeleted(TenantSubscriptionPlan $tenantSubscriptionPlan): void
    {
        //
    }
}
