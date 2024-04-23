<?php

namespace App\Http\Controllers\MainPlatform\Dashboard\Nav;

use App\CentralServices\User\Services\Interfaces\CredentialInterface as CredentialService;
use App\Http\Controllers\Controller;
use App\Models\CentralModel\TenantPlanFeature;
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
        $TenantLatest = Tenant::rightJoin("domains", "tenants.id", "=", "domains.tenant_id")->get()->select(["vendor", "domain"]);
        $TenantCount = Tenant::count();

        Debugbar::debug($TenantCount);
        Debugbar::debug($this->credentialService->getUserAuth());

        Debugbar::debug("tenantLatest : {$TenantLatest}");
        return Inertia::render("views/dashboard/central_page/main_page", [
            "tenantLatest" => $TenantLatest,
            "tenantCount" => $TenantCount
        ]);
    }

    public function SubscriptionPage()
    {

        $planFeatures = Inertia::lazy(function () {
            $planFeaturesQuery = TenantPlanFeature::orderBy("created_at", "desc")->paginate(10);
            $planFeaturesQuery->withPath("/dashboard/subscription?tab=FeaturesTable");

            return $planFeaturesQuery;
        });

        return Inertia::render("views/dashboard/central_page/Subscription_page", compact('planFeatures'));
    }
}
