<?php

namespace App\Http\Controllers\MainPlatform\Dashboard\Nav;

use App\Http\Controllers\Controller;
use App\Models\Auth\CentralCredential;
use App\Models\Gym\Tenant;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class NavigationController extends Controller
{
    public function DashboardPage()
    {
        $TenantLatest = Tenant::rightJoin("domains", "tenants.id", "=", "domains.tenant_id")->get()->select(["vendor", "domain"]);

        Debugbar::info("tenantLatest : {$TenantLatest}");
        return Inertia::render("views/dashboard/mainplatform_page/MainMenu", [
            "tenant_latests" => $TenantLatest
        ]);
    }

    public function SubscriptionPage()
    {
        return Inertia::render("views/dashboard/mainplatform_page/Subscription_page");
    }
}
