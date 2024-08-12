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

        $modalCreate = Inertia::lazy(fn() => true);
        $modalEdit = Inertia::lazy(fn() => true);

        $permissions = [
            'access_dashboard_menu_tenant' => $userLogin->User->hasPermissionTo('access_dashboard_menu_tenant'),
            'access_dashboard_menu_member' => $userLogin->User->hasPermissionTo('access_dashboard_menu_member')
        ];

        $membershipPlans = MembershipPlan::with(['MembershipFeatures'])->paginate(5);
        $getMembershipFeaturesActive = Inertia::lazy(function () {
            return MembershipFeature::where("status", "ACTIVE")->get();
        });
        $membershipPlanEditData = Inertia::lazy(function () use ($request) {
            $id = $request->query("id");
            return MembershipPlan::with(['MembershipFeatures'])->whereId($id)->first();
        });


        return Inertia::render(
            "dashboard/tenant_page/membership_page/plan/Index",
            compact(
                "titlePage",
                "permissions",
                "userLogin",
                'logoutUrl',
                "title",
                "titleNav",
                "indexMenuActive",
                "modalCreate",
                "modalEdit",
                "getMembershipFeaturesActive",
                'membershipPlans',
                'membershipPlanEditData'
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
                $newMembershipPlan->MembershipFeatures()->syncWithPivotValues($feature, ['id' => Str::uuid()], false);
            }

            DB::commit();
        } catch (\Throwable $err) {
            DB::rollBack();
            Log::error($err->getMessage());
            return redirect()->back()->with("message_error", "Failed create new membership plan");
        }
        return redirect()->back()->with("message_success", "Success create new membership plan");
    }

    public function DeleteMembershipPlan(MembershipPlan $membershipPlan)
    {
        $membershipPlan->load("MembershipFeatures");

        DB::beginTransaction();
        try {
            $membershipPlan->MembershipFeatures()->detach();
            $membershipPlan->delete();

            DB::commit();
            return redirect()->back()->with("message_success", "Success delete membership");
        } catch (\Throwable $err) {
            DB::rollBack();
            Log::error($err->getMessage());
            return redirect()->back()->with("message_error", "failed delete membership");
        }
    }

    public function UpdateMembershipPlan(MembershipPlanRequest $request, MembershipPlan $membershipPlan)
    {
        DB::beginTransaction();
        $membershipPlan->load("MembershipFeatures");

        try {
            $requestValidated = $request->validated();

            $membershipPlan->update([
                "title" => $requestValidated['title'],
                "period_type" => $requestValidated['period_type'],
                "status" => $request->status,
                "amount" => (int) $requestValidated['amount'],
                "updated_at" => now()
            ]);

            $membershipPlan->MembershipFeatures()->detach();

            foreach ($requestValidated['features'] as $feature) {
                $membershipPlan->MembershipFeatures()->syncWithPivotValues($feature, ['id' => Str::uuid()], false);
            }

            DB::commit();
        } catch (\Throwable $err) {
            DB::rollBack();
            Log::error($err->getMessage());
            return redirect()->back()->with("message_error", "Failed update new membership plan");
        }
        return redirect()->back()->with("message_success", "Success update new membership plan");
    }
}
