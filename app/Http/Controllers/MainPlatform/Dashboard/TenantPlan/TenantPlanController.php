<?php

namespace App\Http\Controllers\MainPlatform\Dashboard\TenantPlan;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class TenantPlanController extends Controller
{
    public function PlanTablePage()
    {
        return Inertia::render('dashboard/central_page/subscription_page/tenant_plan_page/Index');
    }
}
