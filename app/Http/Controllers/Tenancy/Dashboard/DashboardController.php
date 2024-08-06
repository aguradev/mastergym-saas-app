<?php

namespace App\Http\Controllers\Tenancy\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function Overview()
    {
        $titlePage = tenant('name');
        $title = tenant("name") . " - " . "Dashboard";
        $logoutUrl = "tenant-dashboard.logout";
        $userLogin = Auth::guard("tenant-web")->user();
        $titleNav = "Welcome, " . $userLogin->username;

        return Inertia::render(
            'dashboard/tenant_page/MainMenu',
            compact('title', 'titleNav', 'titlePage', 'logoutUrl', 'userLogin')
        );
    }

    public function Setting()
    {
        $titlePage = tenant('name');
        $title = tenant("name") . " - " . "Setting";
        $logoutUrl = "tenant-dashboard.logout";
        $userLogin = Auth::guard("tenant-web")->user();
        $titleNav = "Settings";
        $indexMenuActive = 6;

        $currentTenant = tenant()->with(['TenantSubscription', 'domains'])->first();

        return Inertia::render(
            'dashboard/tenant_page/setting_page/TenantInformation',
            compact('title', 'titleNav', 'titlePage', 'logoutUrl', 'userLogin', 'indexMenuActive', 'currentTenant')
        );
    }

    public function TenantInvoiceTransaction()
    {
        $titlePage = tenant('name');
        $title = tenant("name") . " - " . "Setting";
        $logoutUrl = "tenant-dashboard.logout";
        $userLogin = Auth::guard("tenant-web")->user();
        $titleNav = "Settings";
        $indexMenuActive = 6;

        $tenantTransactions = tenant()->with(['TenantTransaction'])->first();

        return Inertia::render(
            'dashboard/tenant_page/setting_page/InvoiceTransaction',
            compact('title', 'titleNav', 'titlePage', 'logoutUrl', 'userLogin', 'indexMenuActive', 'tenantTransactions')
        );
    }
}
