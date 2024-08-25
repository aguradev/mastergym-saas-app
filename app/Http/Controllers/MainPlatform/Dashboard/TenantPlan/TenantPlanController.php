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
use App\Models\CentralModel\TenantPlanFeature;
use App\Models\CentralModel\TenantPlanVersion;

class TenantPlanController extends Controller
{
    private $subscriptionPlanService;

    public function __construct(SubscriptionPlanInterface $planInterface)
    {
        $this->subscriptionPlanService = $planInterface;
    }

    public function PlanTablePage(Request $request)
    {
        $getTenantPlanData = $this->subscriptionPlanService->GetAllSubscriptionPlans();
        $userLogin = Auth::guard("central-web")->user();

        $openModalEdit = Inertia::lazy(fn() => true);

        $getTenantDetail = Inertia::lazy(function () use ($request) {
            $tenantPlanId = $request->query("id");
            $versionId = $request->query("versionId");

            if ($versionId) {
                return TenantSubscriptionPlan::where("id", $tenantPlanId)->with(['TenantSelectVersion' => function ($query) use ($versionId) {
                    return $query->where("id", $versionId);
                }, 'TenantSelectVersion.planFeatures'])->first();
            }

            return TenantSubscriptionPlan::where("id", $tenantPlanId)->with(['TenantVersionLatest', 'TenantVersionLatest.planFeatures'])->first();
        });

        $getPlanVersions = Inertia::lazy(function () use ($request) {
            $tenantPlanId = $request->query("id");

            return TenantPlanVersion::where("tenant_subscription_plan_id", $tenantPlanId)->get();
        });

        $getPlanFeatures = Inertia::lazy(function () use ($request) {
            return TenantPlanFeature::all();
        });


        return Inertia::render('dashboard/central_page/subscription_page/tenant_plan_page/Index', compact('userLogin', 'getTenantPlanData', 'openModalEdit', 'getTenantDetail', 'getPlanFeatures', 'getPlanFeatures', 'getPlanVersions'));
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

    public function UpdatePlanAndPlanVersion(Request $request, TenantSubscriptionPlan $planTenant)
    {
        $validated = $request->validate([
            "title" => ["required", "unique:tenant_subscription_plan,name," . $planTenant->id],
            "price_per_month" => ["required", "numeric"],
            "price_per_year" => ["required", "numeric"],
            "features" => ['required'],
            "version_id" => ["required"],
            "version_status" => "required"
        ]);

        $planTenant->load("TenantSelectVersion", "TenantVersionLatest");

        DB::beginTransaction();

        try {
            $findPlanTenantSelector = $planTenant->TenantSelectVersion()->with("PlanFeatures")->where("id", $validated['version_id'])->first();

            if ($findPlanTenantSelector->id != $planTenant->TenantVersionLatest->id) {
                if ($validated['version_status'] == "ACTIVE") {
                    // disabled current version active
                    $planTenant->TenantVersionLatest()->update([
                        "status" => "INACTIVE"
                    ]);
                    // enabled selector version
                    $findPlanTenantSelector->update([
                        "status" => $validated['version_status']
                    ]);
                }
            }

            $planTenant->update([
                "name" => $validated['title']
            ]);

            $findPlanTenantSelector->update([
                "price_per_month" => $validated['price_per_month'],
                "price_per_year" => $validated['price_per_year']
            ]);
            $findPlanTenantSelector->PlanFeatures()->detach();

            foreach ($validated['features'] as $feature) {
                $findPlanTenantSelector->PlanFeatures()->syncWithPivotValues($feature, ["id" => Str::uuid()], false);
            }

            DB::commit();

            return redirect()->back()->with("message_success", "Success update subscription plan");
        } catch (\Throwable $err) {
            DB::rollBack();
            Log::error($err->getMessage());
            return redirect()->back()->with("message_error", "Failed update subscription plan");
        }
    }
}
