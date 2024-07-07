<?php

namespace App\Observers;

use Illuminate\Support\Str;
use App\Models\CentralModel\TenantTransaction;
use Carbon\Carbon;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;
use Illuminate\Support\Facades\Crypt;

class TenantTransactionObserver implements ShouldHandleEventsAfterCommit
{
    /**
     * Handle the TenantTransaction "created" event.
     */
    public function created(TenantTransaction $tenantTransaction): void
    {
        $tenantTransaction->status = "PENDING";
        $tenantTransaction->transaction_expired_at = Carbon::now()->addDay();
        $tenantTransaction->created_at = now();

        $tenantTransaction->save();
    }

    /**
     * Handle the TenantTransaction "updated" event.
     */
    public function updated(TenantTransaction $tenantTransaction): void
    {
        //
    }

    /**
     * Handle the TenantTransaction "deleted" event.
     */
    public function deleted(TenantTransaction $tenantTransaction): void
    {
        //
    }

    /**
     * Handle the TenantTransaction "restored" event.
     */
    public function restored(TenantTransaction $tenantTransaction): void
    {
        //
    }

    /**
     * Handle the TenantTransaction "force deleted" event.
     */
    public function forceDeleted(TenantTransaction $tenantTransaction): void
    {
        //
    }
}
