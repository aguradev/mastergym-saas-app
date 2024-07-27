<?php

use App\Http\Controllers\MainPlatform\Dashboard\Tenant\SubscriptionController;
use Illuminate\Support\Facades\Route;


Route::prefix('tenant-subscriptions')->group(function () {
    Route::controller(SubscriptionController::class)->group(function () {
        Route::get("/", "TenantSubscriptionsPage")->name('central-dashboard.tenant-subscription.index');
    });
});
