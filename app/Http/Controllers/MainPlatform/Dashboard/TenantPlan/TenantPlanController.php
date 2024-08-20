<?php

namespace App\Http\Controllers\MainPlatform\Dashboard\TenantPlan;

use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\CentralModel\TenantSubscriptionPlan;
use App\Http\Requests\CentralRequest\CreateTenantPlanRequest;
use App\CentralServices\SubscriptionPlan\Services\Interfaces\SubscriptionPlanInterface;

class TenantPlanController extends Controller
{
    private $subscriptionPlanService;

    public function __construct(SubscriptionPlanInterface $planInterface)
    {
        $this->subscriptionPlanService = $planInterface;
    }

    public function PlanTablePage()
    {
        $getTenantPlanData = $this->subscriptionPlanService->GetAllSubscriptionPlans();
        $userLogin = Auth::guard("central-web")->user();


        return Inertia::render('dashboard/central_page/subscription_page/tenant_plan_page/Index', compact('userLogin', 'getTenantPlanData'));
    }

    public function AddNewVersionPlanTenant(Request $request, TenantSubscriptionPlan $planTenant)
    {
        $validated = $request->validate([
            "price_per_month" => ["required", "numeric"],
            "price_per_year" => ["required", "numeric"],
            "features" => ['required'],
            "version" => ['required']
        ]);

        $planTenant->load("TenantLogVersions", "TenantLogVersions.PlanFeatures");

        DB::beginTransaction();

        try {

            $formRequestTenantVersion = [
                "price_per_month" => $validated['price_per_month'],
                "price_per_year" => $validated['price_per_year'],
                "status" => "INACTIVE",
                "version" => $validated['version']
            ];

            $createNewVersion = $planTenant->TenantLogVersions()->create($formRequestTenantVersion);

            foreach ($validated['features'] as $feature) {
                $createNewVersion->PlanFeatures()->syncWithPivotValues($feature, ["id" => Str::uuid()], false);
            }

            DB::commit();
        } catch (\Throwable $err) {
            DB::rollBack();
            Log::error($err->getMessage());
            return redirect()->back()->with("message_error", "Failed add new version");
        }

        return redirect()->back()->with("message_success", "Success add new version");
    }

    public function CreatePlanTenant(CreateTenantPlanRequest $request)
    {
        $createPlan = $this->subscriptionPlanService->CreateSubscriptionPlanHandler($request->all());

        if (!$createPlan) {
            return redirect()->back()->with("message_error", "Failed create plan");
        }

        return redirect()->back()->with("message_success", "Successfully create plan");
    }

    public function GetPlanDetail(Request $request, TenantSubscriptionPlan $planTenant)
    {
        $planVersionId = $request->query("planVersionId");

        if (!is_null($planVersionId)) {
            $planTenant->load("TenantLogVersions");

            $planTenant->tenant_version_latest = $planTenant->TenantLogVersions()->with(['PlanFeatures'])->where("id", $planVersionId)->first();

            return response()->json($planTenant)->setStatusCode(200);
        }
        $planTenant->load("TenantVersionLatest", "TenantVersionLatest.PlanFeatures");
        return response()->json($planTenant)->setStatusCode(200);
    }

    public function GetPlanVersions(TenantSubscriptionPlan $planTenant)
    {
        $planTenant->load("TenantLogVersions");

        return response()->json($planTenant)->setStatusCode(200);
    }
}
