<?php

namespace App\Http\Controllers\Tenancy\Dashboard\Trainess;

use App\Http\Controllers\Controller;
use App\Models\TenancyModel\MemberTrainee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UserTrainessController extends Controller
{
    public function TrainessListPage(Request $request)
    {
        $titlePage = tenant('name');
        $title = tenant("name") . " - " . "users";
        $titleNav = "Trainess Management";
        $indexMenuActive = 3;
        $logoutUrl = "tenant-dashboard.logout";
        $userLogin = Auth::guard("tenant-web")->user();

        $permissions = [
            'access_dashboard_menu_tenant' => $userLogin->User->hasPermissionTo('access_dashboard_menu_tenant'),
            'access_dashboard_menu_member' => $userLogin->User->hasPermissionTo('access_dashboard_menu_member')
        ];

        $userTrainess = MemberTrainee::with(["User", "MembershipPlan", "User.TenantCredential"])->paginate(5);
        $memberTrainessDetail = Inertia::lazy(function () use ($request) {
            $trainessId = $request->query("id");

            return MemberTrainee::with(["User", "MembershipPlan", "User.TenantCredential"])->where("id", $trainessId)->first();
        });

        return Inertia::render('dashboard/tenant_page/trainess_page/TrainessManagement', compact(
            'titlePage',
            'title',
            'titleNav',
            'indexMenuActive',
            'logoutUrl',
            'userLogin',
            'permissions',
            'userTrainess',
            'memberTrainessDetail'
        ));
    }
}
