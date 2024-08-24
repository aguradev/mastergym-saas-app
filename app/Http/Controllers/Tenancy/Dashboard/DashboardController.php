<?php

namespace App\Http\Controllers\Tenancy\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Authorization\Role;
use App\Models\CentralModel\TenantTransaction;
use App\Models\TenancyModel\MembershipPlan;
use App\Models\TenancyModel\MemberTrainee;
use App\Models\TenancyModel\User;
use Carbon\Carbon;
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
            'access_dashboard_menu_tenant' => $userLogin->hasPermissionTo('access_dashboard_menu_tenant'),
            'access_dashboard_menu_member' => $userLogin->hasPermissionTo('access_dashboard_menu_member')
        ];

        $staffRoleAssign = $userLogin->hasRole(['Admin', 'Super admin']);
        $memberRoleAssign = $userLogin->hasRole('Member');

        if ($staffRoleAssign) {
            $totalStaff = User::withWhereHas("roles", function ($query) {
                return $query->whereIn("name", ["Super admin", "Admin"]);
            })->count();
            $totalMembershipPlan = MembershipPlan::count();
            $totalTrainee = MemberTrainee::where("membership_status", "ACTIVE")->count();

            $membershipDatasets = MemberTrainee::select(
                DB::raw('SUM(total) as total_income'),
                DB::raw("TO_CHAR(created_at, 'Mon-YYYY') as months"),
                DB::raw("TO_CHAR(created_at, 'MM-YYYY') as code_months"),
            )->where("transaction_status", "PAID")
                ->whereRaw("EXTRACT(YEAR FROM created_at) = ?", [date("Y")])
                ->groupBy(
                    DB::raw("TO_CHAR(created_at, 'Mon-YYYY')"),
                    DB::raw("TO_CHAR(created_at, 'MM-YYYY')")
                )
                ->orderBy(DB::raw("TO_CHAR(created_at, 'MM-YYYY')"))
                ->get();

            return Inertia::render(
                'dashboard/tenant_page/MainMenu',
                compact('title', 'titleNav', 'titlePage', 'logoutUrl', 'userLogin', 'permissions', 'staffRoleAssign', 'memberRoleAssign', 'totalStaff', 'totalMembershipPlan', 'totalTrainee', 'membershipDatasets')
            );
        }

        if ($memberRoleAssign) {
            $user = Auth::guard("tenant-web")->user();
            $user->load("MemberTrainessLatest", "MemberTrainees", "MemberTrainees.MembershipPlan", "MemberTrainees.MembershipPlan.MembershipFeatures");

            $getLatestTrainess = $user->MemberTrainessLatest;
            $findTraineeActive = $user->MemberTrainees->where("membership_status", "ACTIVE")->first();
            $getHistoryTransactionTrainee = MemberTrainee::with("MembershipPlan")->where("user_id", $user->id)->orderBy("created_at", "desc")->limit(3)->get();

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
                compact('title', 'titleNav', 'titlePage', 'logoutUrl', 'userLogin', 'permissions', 'staffRoleAssign', 'memberRoleAssign', 'membershipPricings', 'getMembershipDataSelected', 'vaNumber', 'getLatestTrainess', 'findTraineeActive', 'getHistoryTransactionTrainee')
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

        $tenantId = tenant('id');
        $currentTenant = tenant()->with(['TenantSubscription', 'domains'])->where("id", $tenantId)->first();

        $modalEditTenantActive = Inertia::lazy(fn() => true);

        $permissions = [
            'access_dashboard_menu_tenant' => $userLogin->hasPermissionTo('access_dashboard_menu_tenant'),
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

        $tenantId = tenant('id');
        $tenantTransactions = tenant()->with(['TenantTransaction'])->whereId($tenantId)->first();

        $permissions = [
            'access_dashboard_menu_tenant' => $userLogin->hasPermissionTo('access_dashboard_menu_tenant'),
        ];

        return Inertia::render(
            'dashboard/tenant_page/setting_page/InvoiceTransaction',
            compact('title', 'titleNav', 'titlePage', 'logoutUrl', 'userLogin', 'indexMenuActive', 'tenantTransactions', 'permissions')
        );
    }
}
