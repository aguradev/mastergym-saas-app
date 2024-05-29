<?php

namespace App\Http\Controllers\MainPlatform\Dashboard\TenantPlan;

use App\CentralServices\SubscriptionPlan\Services\Interfaces\SubscriptionPlanInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\CentralRequest\CreateTenantPlanRequest;
use Illuminate\Http\Request;
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
        return Inertia::render('dashboard/central_page/subscription_page/tenant_plan_page/Index');
    }

    public function CreatePlanTenant(CreateTenantPlanRequest $request)
    {
        $createPlan = $this->subscriptionPlanService->CreateSubscriptionPlanHandler($request->all());

        if (!$createPlan) {
            return redirect()->back()->with("message_error", "Failed create plan");
        }

        return redirect()->back()->with("message_success", "Successfully create plan");
    }
}
