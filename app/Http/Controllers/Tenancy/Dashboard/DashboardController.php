<?php

namespace App\Http\Controllers\Tenancy\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Authorization\Role;
use App\Models\CentralModel\TenantTransaction;
use App\Models\TenancyModel\MembershipPlan;
use App\Models\TenancyModel\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function Overview(Request $request)
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

            return Inertia::render(
                'dashboard/tenant_page/MainMenu',
                compact('title', 'titleNav', 'titlePage', 'logoutUrl', 'userLogin', 'permissions', 'staffRoleAssign', 'memberRoleAssign', 'totalStaff', 'totalMembershipPlan')
            );
        }

        if ($memberRoleAssign) {
            $user = Auth::guard("tenant-web")->user();
            $user->load("User.MemberTrainessLatest");

            $getLatestTrainess = $user->User->MemberTrainessLatest;

            $membershipPricings = MembershipPlan::with(["MembershipFeatures"])->where("status", "ACTIVE")->get()->groupBy('period_type');
            $getMembershipDataSelected = Inertia::lazy(function () use ($request) {
                $membershipId = $request->query("membership_id");
                $detail = MembershipPlan::with(["MembershipFeatures"])->where('status', "ACTIVE")->where('id', $membershipId)->first();

                if ($detail) {
                    $detail->tax = "20%";
                    $detail->total = (20 / 100 * $detail->amount) + $detail->amount;
                }

                return $detail;
            });

            $vaNumber = tenant('virtual_account_number');

            return Inertia::render(
                'dashboard/tenant_page/MainMenu',
                compact('title', 'titleNav', 'titlePage', 'logoutUrl', 'userLogin', 'permissions', 'staffRoleAssign', 'memberRoleAssign', 'membershipPricings', 'getMembershipDataSelected', 'vaNumber', 'getLatestTrainess')
            );
        }
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

        $permissions = [
            'access_dashboard_menu_tenant' => $userLogin->User->hasPermissionTo('access_dashboard_menu_tenant'),
        ];

        return Inertia::render(
            'dashboard/tenant_page/setting_page/TenantInformation',
            compact('title', 'titleNav', 'titlePage', 'logoutUrl', 'userLogin', 'indexMenuActive', 'currentTenant', 'modalEditTenantActive', 'permissions')
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

        $permissions = [
            'access_dashboard_menu_tenant' => $userLogin->User->hasPermissionTo('access_dashboard_menu_tenant'),
        ];

        return Inertia::render(
            'dashboard/tenant_page/setting_page/InvoiceTransaction',
            compact('title', 'titleNav', 'titlePage', 'logoutUrl', 'userLogin', 'indexMenuActive', 'tenantTransactions', 'permissions')
        );
    }
}
