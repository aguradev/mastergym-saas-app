<?php

namespace App\Http\Controllers\MainPlatform\Dashboard\Tenant;

use App\Http\Controllers\Controller;
use App\Models\CentralModel\TenantSubscription;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SubscriptionController extends Controller
{
    public function TenantSubscriptionsPage()
    {
        $tenantSubscriptionsLists = TenantSubscription::with(["Tenant.Domains"])->get();

        return Inertia::render('dashboard/central_page/subscription_tenant_page/Index', compact(
            'tenantSubscriptionsLists'
        ));
    }
}
