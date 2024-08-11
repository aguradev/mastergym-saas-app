<?php

namespace App\Http\Controllers\Tenancy\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\CentralModel\TenantTransaction;
use App\Models\TenancyModel\MembershipPlan;
use App\Models\TenancyModel\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

        $permissions = [
            'access_dashboard_menu_tenant' => $userLogin->User->hasPermissionTo('access_dashboard_menu_tenant'),
            'access_dashboard_menu_member' => $userLogin->User->hasPermissionTo('access_dashboard_menu_member')
        ];

        $staffRoleAssign = $userLogin->User->hasRole(['Admin', 'Super admin']);
        $memberRoleAssign = $userLogin->User->hasRole('Member');

        if ($staffRoleAssign) {
            $totalStaff = User::withWhereHas("roles", function ($query) {
                return $query->whereIn("name", ["Super admin", "Admin"]);
            })->count();
            $totalMembershipPlan = MembershipPlan::count();
        }


        return Inertia::render(
            'dashboard/tenant_page/MainMenu',
            compact('title', 'titleNav', 'titlePage', 'logoutUrl', 'userLogin', 'permissions', 'staffRoleAssign', 'memberRoleAssign', 'totalStaff', 'totalMembershipPlan')
        );
    }

    public function Setting()
    {
        $titlePage = tenant('name');
        $title = tenant("name") . " - " . "Setting";
        $logoutUrl = "tenant-dashboard.logout";
        $userLogin = Auth::guard("tenant-web")->user();
        $titleNav = "Settings";
        $indexMenuActive = 5;

        $currentTenant = tenant()->with(['TenantSubscription', 'domains'])->first();
        $modalEditTenantActive = Inertia::lazy(fn() => true);

        return Inertia::render(
            'dashboard/tenant_page/setting_page/TenantInformation',
            compact('title', 'titleNav', 'titlePage', 'logoutUrl', 'userLogin', 'indexMenuActive', 'currentTenant', 'modalEditTenantActive')
        );
    }

    public function TenantInvoiceTransaction()
    {
        $titlePage = tenant('name');
        $title = tenant("name") . " - " . "Setting";
        $logoutUrl = "tenant-dashboard.logout";
        $userLogin = Auth::guard("tenant-web")->user();
        $titleNav = "Settings";
        $indexMenuActive = 5;

        $tenantTransactions = tenant()->with(['TenantTransaction'])->first();

        return Inertia::render(
            'dashboard/tenant_page/setting_page/InvoiceTransaction',
            compact('title', 'titleNav', 'titlePage', 'logoutUrl', 'userLogin', 'indexMenuActive', 'tenantTransactions')
        );
    }
}
