<?php

namespace App\Http\Controllers\MainPlatform\Dashboard\TenantPlan;

use App\CentralServices\SubscriptionPlan\Services\Interfaces\SubscriptionPlanInterface;
use App\Http\Controllers\Controller;
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
}
