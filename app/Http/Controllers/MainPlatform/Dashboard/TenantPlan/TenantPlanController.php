<?php

namespace App\Http\Controllers\MainPlatform\Dashboard\TenantPlan;

use App\CentralServices\SubscriptionPlan\Services\Interfaces\SubscriptionPlanInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\CentralRequest\CreateTenantPlanRequest;
use App\Models\CentralModel\TenantSubscriptionPlan;
use App\Models\Gym\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

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

    public function CreatePlanTenant(CreateTenantPlanRequest $request)
    {
        $createPlan = $this->subscriptionPlanService->CreateSubscriptionPlanHandler($request->all());

        if (!$createPlan) {
            return redirect()->back()->with("message_error", "Failed create plan");
        }

        return redirect()->back()->with("message_success", "Successfully create plan");
    }

    public function GetPlanDetail(TenantSubscriptionPlan $planTenant)
    {
        $planTenant->load("TenantVersionLatest", "TenantVersionLatest.PlanFeatures");
        return response()->json($planTenant)->setStatusCode(200);
    }

    public function GetPlanVersions(TenantSubscriptionPlan $planTenant)
    {
        $planTenant->load("TenantLogVersions");
        return response()->json($planTenant)->setStatusCode(200);
    }
}
