<?php

namespace App\Http\Controllers\Tenancy\Dashboard\Memberships;

use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\TenancyModel\MembershipPlan;
use App\Models\TenancyModel\MembershipFeature;
use App\Http\Requests\TenantRequest\MembershipPlanRequest;
use Illuminate\Support\Facades\Auth;

class MembershipPlanController extends Controller
{
    public function Page(Request $request)
    {
        $titlePage = tenant('name');
        $title = tenant("name") . " - " . "Membership plan";
        $titleNav = "Membership management";
        $indexMenuActive = 2;
        $logoutUrl = "tenant-dashboard.logout";
        $userLogin = Auth::guard("tenant-web")->user();

        $modalCreate = Inertia::lazy(fn () => true);
        $modalEdit = Inertia::lazy(fn () => true);

        $membershipPlans = MembershipPlan::with(['MembershipFeatures'])->paginate(5);
        $getMembershipFeaturesActive = Inertia::lazy(function () {
            return MembershipFeature::where("status", "ACTIVE")->get();
        });

        return Inertia::render(
            "dashboard/tenant_page/membership_page/plan/Index",
            compact(
                "titlePage",
                "userLogin",
                'logoutUrl',
                "title",
                "titleNav",
                "indexMenuActive",
                "modalCreate",
                "modalEdit",
                "getMembershipFeaturesActive",
                'membershipPlans'
            )
        );
    }

    public function DetailPage(MembershipPlan $membershipPlan)
    {
        $membershipPlan->load("MembershipFeatures");

        $titlePage = tenant('name');
        $title = tenant("name") . " - " . "Membership plan";
        $titleNav = "Membership management";
        $indexMenuActive = 2;
        $userLogin = Auth::guard("tenant-web")->user();

        return Inertia::render(
            "dashboard/tenant_page/membership_page/plan/MembershipPlanDetail",
            compact(
                'userLogin',
                'titlePage',
                'title',
                'titleNav',
                'indexMenuActive',
                'membershipPlan'
            )
        );
    }

    public function CreateMembershipPlan(MembershipPlanRequest $request)
    {
        DB::beginTransaction();
        try {
            $requestValidated = $request->validated();

            $newMembershipPlan = MembershipPlan::create([
                "title" => $requestValidated['title'],
                "period_type" => $requestValidated['period_type'],
                "status" => "ACTIVE",
                "amount" => (int) $requestValidated['amount'],
                "created_at" => now()
            ]);

            foreach ($requestValidated['features'] as $feature) {
                $newMembershipPlan->MembershipFeatures()->syncWithPivotValues($feature['id'], ['id' => Str::uuid()], false);
            }

            DB::commit();
        } catch (\Throwable $err) {
            DB::rollBack();
            Log::error($err->getMessage());
            return redirect()->back()->with("message_error", "Failed create new membership plan");
        }
        return redirect()->back()->with("message_success", "Success create new membership plan");
    }
}
