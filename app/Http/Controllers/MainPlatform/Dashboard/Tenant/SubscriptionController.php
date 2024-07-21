<?php

namespace App\Http\Controllers\MainPlatform\Dashboard\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SubscriptionController extends Controller
{
    public function TenantSubscriptionsPage()
    {
        return Inertia::render('dashboard/central_page/subscription_tenant_page/Index');
    }
}
