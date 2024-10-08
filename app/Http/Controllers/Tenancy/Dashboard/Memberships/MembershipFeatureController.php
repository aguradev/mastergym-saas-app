<?php

namespace App\Http\Controllers\Tenancy\Dashboard\Memberships;

use App\Http\Controllers\Controller;
use App\Models\TenancyModel\MembershipFeature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class MembershipFeatureController extends Controller
{
    public function Page(Request $request)
    {
        $titlePage = tenant('name');
        $title = tenant("name") . " - " . "Membership features";
        $titleNav = "Membership management";
        $indexMenuActive = 2;
        $logoutUrl = "tenant-dashboard.logout";
        $userLogin = Auth::guard("tenant-web")->user();

        $permissions = [
            'access_dashboard_menu_tenant' => $userLogin->hasPermissionTo('access_dashboard_menu_tenant'),
            'access_dashboard_menu_member' => $userLogin->hasPermissionTo('access_dashboard_menu_member')
        ];

        $modalCreate = Inertia::lazy(fn() => true);
        $modalEdit = Inertia::lazy(fn() => true);
        $membershipFeatures = MembershipFeature::withCount(["membershipPlans"])->latest()->paginate(5);

        $getMembershipDetail = Inertia::lazy(function () use ($request) {
            $queryId = $request->query("id");
            return MembershipFeature::whereId($queryId)->first();
        });

        return Inertia::render(
            "dashboard/tenant_page/membership_page/feature/Index",
            compact(
                "titlePage",
                "permissions",
                "userLogin",
                "title",
                "logoutUrl",
                "titleNav",
                "indexMenuActive",
                "modalCreate",
                "modalEdit",
                "membershipFeatures",
                "getMembershipDetail"
            )
        );
    }

    public function CreateFeature(Request $request)
    {
        $request->validate([
            "title" => "required|unique:membership_plan_features,title"
        ]);

        try {
            MembershipFeature::create([
                "title" => $request->title,
                "created_at" => now(),
                "status" => "ACTIVE"
            ]);
        } catch (\Throwable $err) {
            Log::error($err->getMessage());
            return redirect()->back()->with("message_error", "Failed create new feature");
        }
        return redirect()->back()->with("message_success", "Success create new feature");
    }

    public function DeleteFeature(MembershipFeature $membershipFeature)
    {
        try {
            $membershipFeature->delete();
        } catch (\Throwable $err) {
            Log::error($err->getMessage());
            return redirect()->back()->with("message_error", "Failed delete feature");
        }
        return redirect()->back()->with("message_success", "Success delete feature");
    }

    public function UpdateFeature(Request $request, MembershipFeature $membershipFeature)
    {
        $request->validate([
            "title" => "required|unique:membership_plan_features,title," . $membershipFeature->id,
        ]);

        try {
            $membershipFeature->update([
                "title" => $request->title,
                "updated_at" => now(),
                "status" => $request->status
            ]);
        } catch (\Throwable $err) {
            Log::error($err->getMessage());
            return redirect()->back()->with("message_error", "Failed update feature");
        }
        return redirect()->back()->with("message_success", "Success update feature");
    }
}
