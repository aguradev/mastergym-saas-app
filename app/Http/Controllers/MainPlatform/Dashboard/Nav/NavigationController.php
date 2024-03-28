<?php

namespace App\Http\Controllers\MainPlatform\Dashboard\Nav;

use App\CentralServices\User\Services\Interfaces\CredentialInterface as CredentialService;
use App\Http\Controllers\Controller;
use App\Models\Gym\Tenant;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class NavigationController extends Controller
{
    private $credentialService;

    function __construct(CredentialService $credentialService)
    {
        $this->credentialService = $credentialService;
    }
    public function DashboardPage()
    {
        Debugbar::debug($this->credentialService->getUserAuth());
        $TenantLatest = Tenant::rightJoin("domains", "tenants.id", "=", "domains.tenant_id")->get()->select(["vendor", "domain"]);
        $TenantCount = Tenant::count();

        Debugbar::debug($TenantCount);

        Debugbar::debug("tenantLatest : {$TenantLatest}");
        return Inertia::render("views/dashboard/central_page/main_page", [
            "tenantLatest" => $TenantLatest,
            "tenantCount" => $TenantCount
        ]);
    }

    public function SubscriptionPage()
    {
        return Inertia::render("views/dashboard/central_page/Subscription_page");
    }
}
