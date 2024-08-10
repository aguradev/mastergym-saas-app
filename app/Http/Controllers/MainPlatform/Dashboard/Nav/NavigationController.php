<?php

namespace App\Http\Controllers\MainPlatform\Dashboard\Nav;

use App\CentralServices\User\Services\Interfaces\CredentialInterface as CredentialService;
use App\Http\Controllers\Controller;
use App\Models\CentralModel\TenantSubscriptionPlan;
use App\Models\CentralModel\TenantTransaction;
use App\Models\Gym\Tenant;
use Barryvdh\Debugbar\Facades\Debugbar;
use DebugBar\DebugBar as DebugBarDebugBar;
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
        $TenantLatest = Tenant::rightJoin("domains", "tenants.id", "=", "domains.tenant_id")->where("status", "ACTIVE")->limit(5)->get()->select(["name", "domain"]);
        $tenantPlansCount = TenantSubscriptionPlan::count();
        $userLogin = Auth::guard("central-web")->user();

        $transactionLatest = TenantTransaction::latest()->limit(3)->get();

        $TenantCount = Tenant::count();

        Debugbar::debug($TenantCount);
        Debugbar::debug($transactionLatest);
        Debugbar::debug($this->credentialService->getUserAuth());

        Debugbar::debug("tenantLatest : {$TenantLatest}");
        return Inertia::render("dashboard/central_page/Overview", [
            "userLogin" => $userLogin,
            "tenantLatest" => $TenantLatest,
            "tenantCount" => $TenantCount,
            "transactionLatest" => $transactionLatest,
            "planCount" => $tenantPlansCount
        ]);
    }

    public function PlanOverviewMenu()
    {
        return Inertia::render("dashboard/central_page/subscription_page/Index");
    }
}
